<?php

namespace SmallRuralDog\AmisAdmin\Controllers;

use Illuminate\Database\Eloquent\Model;
use SmallRuralDog\AmisAdmin\Components\Form;
use SmallRuralDog\AmisAdmin\Components\Grid;
use SmallRuralDog\AmisAdmin\Renderers\Alert;
use SmallRuralDog\AmisAdmin\Renderers\Each;
use SmallRuralDog\AmisAdmin\Renderers\Form\Checkboxes;
use SmallRuralDog\AmisAdmin\Renderers\Form\Group;
use SmallRuralDog\AmisAdmin\Renderers\Form\InputTree;
use SmallRuralDog\AmisAdmin\Renderers\Form\Select;
use SmallRuralDog\AmisAdmin\Renderers\Form\Transfer;
use SmallRuralDog\AmisAdmin\Renderers\Form\TreeSelect;
use SmallRuralDog\AmisAdmin\Renderers\Tab;
use SmallRuralDog\AmisAdmin\Renderers\Tabs;
use SmallRuralDog\AmisAdmin\Renderers\Tpl;
use Str;

class PermissionController extends AdminController
{
    private string $routeName = "amis-admin.permission";

    protected function grid()
    {

        $model = config('amis-admin.database.permissions_model');

        return Grid::make($model::query(), $this->routeName, function (Grid $grid) {


            $grid
                ->loadDataOnce()
                ->toTree()
                ->disableBulkDelete();

            $grid->useCRUD()
                ->expandConfig([
                    'expand' => 'all'
                ])
                ->perPage(100)
                ->keepItemSelectionOnPageChange(true);


            $grid->usePage()->title("权限管理")->remark("在这里你可以管理权限");

            $grid->column('slug', "标识")->useTableColumn()->copyable(true);
            $grid->column('name', "名称")->useTableColumn();
            $grid->column('http_method', "请求方式")
                ->useTableColumn(Each::make()->placeholder("<span class='label label-default'>ANY</span>")
                    ->items(Tpl::make()->tpl("<span class='label label-default m-l-sm'><%= this.item %></span>")));
            $grid->column('http_path', "路由")
                ->useTableColumn(Each::make()->items(Tpl::make()->tpl("<span class='label label-default m-l-sm'><%= this.item %></span>")));


            $grid->dialogForm('lg');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->wrapWithPanel(false)->className('mb-3 bg-search p-2 pt-3');
                $filter->like('slug', "标识")->useFormItem()->clearable(true)->size("sm");
            });

            $grid->actions(function (Grid\Actions $actions) {
                $actions->width(200);
                $actions->rowAction();
            });


            $grid->toolbar(function (Grid\Toolbar $toolbar) {

            });

        });
    }

    protected function form(): Form
    {

        $model = config('amis-admin.database.permissions_model');
        return Form::make($model::query(), $this->routeName, function (Form $form) use ($model) {
            $form->customLayout([
                Group::make()
                    ->body([
                        $form->item('parent_id', '父级')
                            ->useFormItem(TreeSelect::make()->options(function () use ($model) {
                                $list = $model::query()->orderBy('order')->get()->toArray();
                                return arr2tree($list);
                            })->labelField('name')->valueField("id")->value(0)),
                        $form->item('slug', '标识')
                            ->required()
                            ->useFormItem(),
                        $form->item('name', "名称")
                            ->useFormItem()->required(true),
                    ]),
                $form->item('http_method', "请求方式")
                    ->useFormItem(Checkboxes::make()->multiple(true)
                        ->extractValue(true)
                        ->joinValues(false)
                        ->options($this->getHttpMethods())),

                Tabs::make()
                    ->tabsMode("chrome")
                    ->className('mb-2')
                    ->tabs([
                        Tab::make()->title("路由设置")->body(function () use ($form) {
                            return $form->item('http_path', " ")
                                ->useFormItem(Transfer::make()->options($this->getRoutes())
                                    ->extractValue(true)
                                    ->joinValues(false)
                                    ->searchable(true)
                                    ->multiple(true)
                                    ->clearable(true));
                        }),
                        Tab::make()->title("菜单设置")->body(function () use ($form) {
                            return [
                                Alert::make()->body("权限与菜单绑定，当用户拥有该权限时，菜单将会显示，可以简化角色与菜单当权限的绑定操作")->showIcon(true),
                                $form->item('menus', ' ')
                                    ->useFormItem(InputTree::make()
                                        ->extractValue(true)
                                        ->joinValues(false)
                                        ->labelField("title")
                                        ->valueField("id")
                                        ->multiple(true)
                                        ->cascade(true)
                                        ->showOutline(true)
                                        ->options(function () {
                                            $model = config('amis-admin.database.menu_model');
                                            $list = $model::query()
                                                ->orderBy('order')->get()->toArray();
                                            return arr2tree($list);
                                        }))];
                        }),
                    ]),
                $form->item('roles', "授权角色")
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
        });
    }

    public function getRoutes(): array
    {
        $prefix = (string)config('amis-admin.route.prefix');

        $container = collect();
        $routes = collect(app('router')->getRoutes())->map(function ($route) use ($prefix, $container) {
            if (!Str::startsWith($uri = $route->uri(), $prefix) && $prefix && $prefix !== '/') {
                return null;
            }
            if (!Str::contains($uri, '{')) {
                if ($prefix !== '/') {
                    $route = Str::replaceFirst($prefix, '', $uri . '*');
                } else {
                    $route = $uri . '*';
                }
                if ($route !== '*') {
                    $container->push($route);
                }
            }
            $path = preg_replace('/{.*}+/', '*', $uri);
            if ($prefix !== '/') {
                return Str::replaceFirst($prefix, '', $path);
            }
            return $path;
        });
        return $container->merge($routes)->filter()->unique()->map(function ($method) {
            return [
                'value' => $method,
                'label' => $method
            ];
        })->values()->all();
    }

    private function getHttpMethods(): array
    {

        $permissionModel = config('amis-admin.database.permissions_model');
        return collect($permissionModel::$httpMethods)->map(function ($method) {
            return [
                'value' => $method,
                'label' => $method
            ];
        })->toArray();
    }
}
