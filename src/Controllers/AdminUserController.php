<?php

namespace SmallRuralDog\AmisAdmin\Controllers;

use AmisAdmin;
use Illuminate\Database\Eloquent\Model;
use SmallRuralDog\AmisAdmin\Components\Form;
use SmallRuralDog\AmisAdmin\Components\Grid;
use SmallRuralDog\AmisAdmin\Renderers\Action\AjaxAction;
use SmallRuralDog\AmisAdmin\Renderers\Avatar;
use SmallRuralDog\AmisAdmin\Renderers\Date;
use SmallRuralDog\AmisAdmin\Renderers\Each;
use SmallRuralDog\AmisAdmin\Renderers\Flex;
use SmallRuralDog\AmisAdmin\Renderers\Form\Group;
use SmallRuralDog\AmisAdmin\Renderers\Form\InputImage;
use SmallRuralDog\AmisAdmin\Renderers\Form\InputText;
use SmallRuralDog\AmisAdmin\Renderers\Form\Select;
use SmallRuralDog\AmisAdmin\Renderers\Tpl;

class AdminUserController extends AdminController
{
    protected function grid(): Grid
    {
        $model = config('amis-admin.database.users_model');
        return Grid::make($model::query(), 'amis-admin.user', function (Grid $grid) {
            $grid->useCRUD()->columnsTogglable(false);
            $grid->dialogForm();
            $grid->column('id', 'ID')->width(40);
            $grid->column('avatar', '头像')
                ->width(60)
                ->align('center')
                ->useTableColumn(Avatar::make()->src('${avatar}'));
            $grid->column('username', '用户名')->width(100);
            $grid->column('name', '姓名')->width(100);
            $grid->column('roles', '角色')
                ->useTableColumn(Each::make()->items(Tpl::make()->tpl("<span class='label label-default m-l-sm'><%= this.name %></span>")));
            $grid->column('created_at', '创建时间')->width(250)->sortable(true)
                ->useTableColumn(Date::make()->datetime());
            $grid->actions(function (Grid\Actions $actions) {
                $actions->rowAction();

                $actions->callDeleteAction(function (AjaxAction $action) {
                    $id = AmisAdmin::user()?->getKey();
                    $action->hiddenOn("id==$id"); //这里使用了显隐判断
                });

            });
        });
    }

    protected function form(): Form
    {
        $model = config('amis-admin.database.users_model');

        $userTable = config('amis-admin.database.users_table');
        $connection = config('amis-admin.database.connection');

        return Form::make($model::query(), 'amis-admin.user', function (Form $form) use ($userTable, $connection) {


            $form->customLayout([

                Flex::make()
                    ->justify('flex-start')
                    ->alignItems('start')
                    ->items([
                        $form->item('avatar', ' ')
                            ->useFormItem(InputImage::make()->placeholder('xxx')),
                        Group::make()
                            ->className('flex-1')
                            ->body([
                                $form->item('username', '用户名')
                                    ->required()
                                    ->createRules(["unique:$connection.$userTable"], ["unique" => '用户名已存在'])
                                    ->updateRules(["unique:$connection.$userTable,username,$this->resourceKey"], ["unique" => '用户名已存在'])
                                    ->useFormItem()->columnRatio(12),
                                $form->item('name', '名称')
                                    ->required()
                                    ->useFormItem()->className('mt-2'),
                            ]),
                    ]),
                $form->item('password', '密码')
                    ->rules(['confirmed'], ['confirmed' => '两次密码不一致'])
                    ->createRules(['required', 'string'])
                    ->useFormItem(InputText::make()->password())
                    ->required($this->isCreate),
                $form->item('password_confirmation', '确认密码')
                    ->useFormItem(InputText::make()->password())
                    ->required($this->isCreate),

                $form->item('roles', "角色")
                    ->useFormItem(Select::make()->extractValue(true)
                        ->joinValues(false)
                        ->multiple(true)
                        ->labelField("name")
                        ->valueField("id")
                        ->searchable(true)
                        ->options(function () {
                            /**@var Model $model */
                            $model = config('amis-admin.database.roles_model');
                            return $model::all();
                        })),
            ]);

            $form->editData(function (Form $form) {
                $form->deleteEditData('password');
            });

            $form->saving(function (Form $form) {
                if ($form->password && $form->model()->get('password') != $form->password) {
                    $form->password = bcrypt($form->password);
                }
                if (!$form->password) {
                    $form->deleteInput('password');
                }
            });

        });

    }
}
