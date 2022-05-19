<?php

namespace SmallRuralDog\AmisAdmin\Components\Form;

use SmallRuralDog\AmisAdmin\Components\Form;
use SmallRuralDog\AmisAdmin\Renderers\Action\LinkAction;
use SmallRuralDog\AmisAdmin\Renderers\Button;

class Toolbar
{

    private bool $disableList = false;

    protected array $prependToolbarList = [];
    protected array $addToolbarList = [];

    public function __construct(protected Form $form)
    {
    }

    /**
     * 构造新增按钮操作
     * @return Button
     */
    private function buildListButton(): Button
    {
        $link = admin_route($this->form->getIndexUrl());
        return LinkAction::make()->label("列表")->level('primary')->icon('fa fa-list')->link($link);
    }

    private function buildBackButton(): Button
    {
        return LinkAction::make()->label("返回")->link("back()");
    }

    /**
     * Toolbar 系统默认
     * @return array
     */
    private function initToolbar(): array
    {
        $res = collect([]);


        if (!$this->disableList) $res->add($this->buildListButton());
        $res->add($this->buildBackButton());
        return $res->toArray();
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
}
