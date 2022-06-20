<?php

namespace SmallRuralDog\AmisAdmin\Components;

use Illuminate\Database\Eloquent\Builder;
use JsonSerializable;
use SmallRuralDog\AmisAdmin\Components\Grid\Actions;
use SmallRuralDog\AmisAdmin\Components\Grid\Filter;
use SmallRuralDog\AmisAdmin\Components\Grid\GridCRUD;
use SmallRuralDog\AmisAdmin\Components\Grid\GridData;
use SmallRuralDog\AmisAdmin\Components\Grid\GridDialogForm;
use SmallRuralDog\AmisAdmin\Components\Grid\GridToolbar;
use SmallRuralDog\AmisAdmin\Components\Grid\GridTree;
use SmallRuralDog\AmisAdmin\Components\Grid\Model;
use SmallRuralDog\AmisAdmin\Components\Grid\Toolbar;
use SmallRuralDog\AmisAdmin\Renderers\CRUD;
use SmallRuralDog\AmisAdmin\Renderers\Page;

class Grid implements JsonSerializable
{

    use GridCRUD, GridData, GridToolbar, ModelBase, GridTree, GridDialogForm;


    protected Page $page;

    protected string $routeName;
    protected Model $model;

    protected string $_action;

    public function __construct()
    {
        $this->page = Page::make()->title("列表");
        $this->crud = CRUD::make();
        $this->filter = new Filter();
        $this->actions = new Actions($this);
        $this->toolbar = new Toolbar($this);

        $this->_action = (string)request('_action');
    }

    public static function make($model, string $routeName, $fun): Grid
    {
        $grid = new static();
        $grid->model = new Model($model, $grid);
        $grid->routeName = $routeName;
        $fun($grid);
        return $grid;
    }

    /**
     * 获取AmisPage实例
     * @return Page
     */
    public function usePage(): Page
    {
        return $this->page;
    }

    public function builder(): Builder
    {
        return $this->model->getBuilder();
    }

    public function jsonSerialize()
    {
        //获取数据
        if ($this->_action === "getData") {
            return $this->buildData();
        }
        $this->page
            ->toolbar($this->toolbar->renderToolbar())
            ->body([
                $this->renderCRUD(),
            ]);

        return $this->page;
    }
}
