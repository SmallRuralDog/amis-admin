<?php

namespace SmallRuralDog\AmisAdmin\Components\Grid;

use SmallRuralDog\AmisAdmin\Components\Grid;
use SmallRuralDog\AmisAdmin\Renderers\Action\AjaxAction;
use SmallRuralDog\AmisAdmin\Renderers\Action\LinkAction;
use SmallRuralDog\AmisAdmin\Renderers\Action\ReloadAction;
use SmallRuralDog\AmisAdmin\Renderers\Button;

class Toolbar
{
    protected Grid $grid;

    protected bool $disableCreate = false;

    protected array $prependToolbarList = [];
    protected array $addToolbarList = [];

    protected array $prependHeaderToolbarList = [];
    protected array $addHeaderToolbarList = [];

    private bool $disableBulkDelete = false;
    private array $addBulkActionList = [];


    public function __construct(Grid $grid)
    {
        $this->grid = $grid;
    }


    /**
     * 构造新增按钮操作
     * @return Button
     */
    private function buildCreateButton(): Button
    {
        if ($this->grid->isDialogForm()) {
            $link = 'get:' . $this->grid->getCreateUrl(['_dialog' => 1]);
            return $this->grid->renderDialogForm($link);
        }

        $link = admin_route($this->grid->getCreateUrl());
        return LinkAction::make()->label("新增")->level('primary')->icon('fa fa-add')->link($link);

    }

    private function buildReloadButton(): Button{
        return ReloadAction::make()->target($this->grid->getCrudName())->icon('fa fa-refresh')->label("刷新");
    }

    /**
     * 禁用新增按钮
     * @param bool $bool
     * @return void
     */
    public function disableCreate(bool $bool = true): void
    {
        $this->disableCreate = $bool;
    }


    /**
     * Toolbar 系统默认
     * @return array
     */
    private function initToolbar(): array
    {
        $res = [];

        if (!$this->disableCreate) $res[] = $this->buildCreateButton();

        return $res;
    }

    /**
     * Toolbar 前置
     * @param $node
     * @return $this
     */
    public function prependToolbar($node): Toolbar
    {
        $this->prependToolbarList[] = $node;
        return $this;
    }

    /**
     * Toolbar 后置
     * @param $node
     * @return $this
     */
    public function addToolbar($node): Toolbar
    {
        $this->addToolbarList[] = $node;
        return $this;
    }

    /**
     * 渲染页面Toolbar
     * renderToolbar
     * @return array
     */
    public function renderToolbar(): array
    {
        $res = collect([]);
        foreach ($this->prependToolbarList as $node) {
            $res->prepend($node);
        }
        foreach ($this->initToolbar() as $node) {
            $res->add($node);
        }
        foreach ($this->addToolbarList as $node) {
            $res->add($node);
        }
        return $res->toArray();
    }

    /**
     * HeaderToolbar 系统默认
     * @return array
     */
    private function initHeaderToolbar(): array
    {
        $res = collect([]);
        $res->add("reload");
        $res->add("bulkActions");
        $res->add("pagination");
        return $res->toArray();
    }

    /**
     * HeaderToolbar 前置
     * @param $node
     * @return $this
     */
    public function prependHeaderToolbar($node): Toolbar
    {
        $this->prependHeaderToolbarList[] = $node;
        return $this;
    }

    /**
     * HeaderToolbar 后置
     * @param $node
     * @return $this
     */
    public function addHeaderToolbar($node): Toolbar
    {
        $this->addHeaderToolbarList[] = $node;
        return $this;
    }

    /**
     * 渲染CRUD头部Toolbar
     * renderHeaderToolbar
     * @return array
     */
    public function renderHeaderToolbar(): array
    {

        $res = collect([]);

        foreach ($this->prependHeaderToolbarList as $node) {
            $res->prepend($node);
        }

        foreach ($this->initHeaderToolbar() as $node) {
            $res->add($node);
        }
        foreach ($this->addHeaderToolbarList as $node) {
            $res->add($node);
        }

        return $res->toArray();
    }

    private function initFooterToolbar(): array
    {
        $res = collect([]);
        $res->add("statistics");
        $res->add("switch-per-page");
        $res->add("pagination");
        return $res->toArray();
    }

    /**
     * 渲染CRUD尾部Toolbar
     * renderFooterToolbar
     * @return array
     */
    public function renderFooterToolbar(): array
    {
        $res = collect([]);

        foreach ($this->initFooterToolbar() as $node) {
            $res->add($node);
        }

        return $res->toArray();
    }


    /**
     * 禁用批量删除
     * @param bool $bool
     * @return void
     */
    public function disableBulkDelete(bool $bool = true): void
    {
        $this->disableBulkDelete = $bool;
    }


    /**
     * 批量操作系统默认
     * @return array
     */
    private function initBulkAction(): array
    {
        $res = collect([]);

        if (!$this->disableBulkDelete) {
            $api = $this->grid->getDestroyUrl($this->grid->getBulkSelectIds());
            $res->add(AjaxAction::make()->label("批量删除")->api($api)->icon("fa fa-trash")->confirmText("确定要删除吗？"));
        }
        return $res->toArray();
    }


    /**
     * 添加批量操作
     * @param $node
     * @return void
     */
    public function addBulkAction($node): void
    {
        $this->addBulkActionList[] = $node;
    }

    /**
     * 渲染批量操作
     * @return array
     */
    public function renderBulkActions(): array
    {
        $res = collect([]);

        foreach ($this->initBulkAction() as $node) {
            $res->add($node);
        }
        foreach ($this->addBulkActionList as $node) {
            $res->add($node);
        }
        return $res->toArray();
    }
}
