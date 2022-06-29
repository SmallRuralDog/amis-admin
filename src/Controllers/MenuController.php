<?php

namespace SmallRuralDog\AmisAdmin\Controllers;

use Illuminate\Database\Eloquent\Model;
use SmallRuralDog\AmisAdmin\Components\Form;
use SmallRuralDog\AmisAdmin\Components\Grid;
use SmallRuralDog\AmisAdmin\Models\Menu;
use SmallRuralDog\AmisAdmin\Renderers\Alert;
use SmallRuralDog\AmisAdmin\Renderers\Divider;
use SmallRuralDog\AmisAdmin\Renderers\Form\Group;
use SmallRuralDog\AmisAdmin\Renderers\Form\IconPicker;
use SmallRuralDog\AmisAdmin\Renderers\Form\InputArray;
use SmallRuralDog\AmisAdmin\Renderers\Form\InputKV;
use SmallRuralDog\AmisAdmin\Renderers\Form\InputNumber;
use SmallRuralDog\AmisAdmin\Renderers\Form\InputText;
use SmallRuralDog\AmisAdmin\Renderers\Form\Select;
use SmallRuralDog\AmisAdmin\Renderers\Form\TreeSelect;
use SmallRuralDog\AmisAdmin\Renderers\Tpl;

class MenuController extends AdminController
{

    protected function grid()
    {
        /**@var Model $model */
        $model = config('amis-admin.database.menu_model');
        return Grid::make($model::query(), 'amis-admin.menu', function (Grid $grid) {

            $grid->builder()->orderBy('order');

            $grid->useCRUD()->columnsTogglable(false)->expandConfig([
                'expand' => 'all',
            ]);

            $grid->loadDataOnce()->toTree()->disableBulkDelete()->useCRUD()->perPage(100);

            $grid->column('title', '名称')->useTableColumn()->quickEdit(true);

            $grid->column('key', '标识')->useTableColumn()->quickEdit(true);

            $grid->column('icon', '图标')->useTableColumn(Tpl::make()->tpl('<i class="${icon}"></i> ${icon}'));

            $grid->column('uri', '链接')->useTableColumn()->quickEdit(true);

            $grid->column('order', '排序')->width(100)->inputNumber(true)->useTableColumn();

            $grid->column('hidden', '隐藏')->width(100)->align('center')->switch()->useTableColumn();

            $grid->dialogForm('lg');
            $grid->actions(function (Grid\Actions $actions) {
                $actions->rowAction();
            });
            $grid->filter(function (Grid\Filter $filter) {
                $filter->wrapWithPanel(false)->className('mb-3 bg-search p-2 pt-3');
                $filter->like('title', '名称')->useFormItem()->size("sm");
                $filter->like('key', '标识')->useFormItem()->size("sm");
            });
        });
    }

    protected function form()
    {
        /**@var Model $model */
        $model = config('amis-admin.database.menu_model');
        return Form::make($model::query(), 'amis-admin.menu', function (Form $form) {
            $form->customLayout([

                Alert::make()->body("新增菜单，需要在角色管理内配置权限才可使用")->level('warning')->showIcon(true),

                Group::make()->body([
                    $form->item('title', '名称')->useFormItem()->required(true)->description("菜单显示名称"),
                    $form->item('key', '标识')
                        ->required()
                        ->useFormItem()->description("菜单标识，必填并且不能重复"),
                    $form->item('icon', '图标')->useFormItem(IconPicker::make())
                        ->requiredOn('parent_id==0')
                        ->description("可以使用<a target='_blank' href='https://fontawesome.com/search?m=free'>Font Awesome</a>图标")->placeholder("fa fa-xxx"),
                ]),

                Group::make()->body([
                    $form->item('parent_id', '父级菜单')
                        ->useFormItem(TreeSelect::make()->options(function () {
                            $list = Menu::query()->orderBy('order')->get()->toArray();
                            return [
                                ['id' => 0, 'title' => '顶级菜单', 'children' => arr2tree($list)],
                            ];
                        })->labelField('title')->valueField("id")->value(0)),
                    $form->item('hidden', '隐藏')
                        ->useFormItem(Select::make()->options([
                            ['value' => 0, 'label' => '否'],
                            ['value' => 1, 'label' => '是'],
                        ])->value(0)),
                    $form->item('order', '排序')->useFormItem(InputNumber::make()->value(1)->min(1)->labelRemark('数字越小越靠前')),
                ]),

                Group::make()->body([
                    $form->item('uri_type', '链接类型')
                        ->useFormItem(Select::make()->options([
                            ['value' => 'route', 'label' => '路由链接'],
                            ['value' => 'url', 'label' => '外部链接'],
                        ]))->value('route')->columnRatio(2),

                    $form->item('target', '打开方式')->useFormItem(
                        Select::make()->options([
                            ['value' => '_self', 'label' => '当前窗口'],
                            ['value' => '_blank', 'label' => '新窗口'],
                        ]))->value('_self')->columnRatio(2)->labelRemark("外部连接类型有效"),

                    $form->item('uri', '路由')
                        ->description("注意：不要使用二级目录,否则菜单无法自动选中")
                        ->useFormItem()->visibleOn("data.uri_type=='route'"),
                    $form->item('uri', '外部链接')->useFormItem()->type("input-url")->clearable(true)->visibleOn("data.uri_type=='url'")->placeholder("https://xxx.xxx.xxx.xxx"),

                ]),
                Divider::make(),
                $form->item('roles', "授权角色")->useFormItem(Select::make()->extractValue(true)
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
                Divider::make(),

                $form->item('active_menus', '菜单匹配')->useFormItem(InputArray::make()->items(InputText::make())),

                $form->item('params', '自定义路由参数')->useFormItem(InputKV::make()),

            ]);
        });
    }
}
