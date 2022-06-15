<?php

namespace SmallRuralDog\AmisAdmin\Components\Grid;

use Closure;
use SmallRuralDog\AmisAdmin\Components\Grid;
use SmallRuralDog\AmisAdmin\Renderers\Action\AjaxAction;
use SmallRuralDog\AmisAdmin\Renderers\Action\LinkAction;
use SmallRuralDog\AmisAdmin\Renderers\Button;
use SmallRuralDog\AmisAdmin\Renderers\DropdownButton;

class Actions
{


    protected Grid $grid;

    protected bool $disableDeleteAction = false;
    protected bool $disableEditAction = false;

    protected bool $hoverAction = false;
    protected bool $rowAction = false;

    protected array $prependList = [];
    protected array $addList = [];

    protected float|string $width = 150;

    protected ?Closure $callDeleteActionFun = null;
    protected ?Closure $callEditActionFun = null;

    public function __construct(Grid $grid)
    {
        $this->grid = $grid;
    }


    private function buildDeleteAction(): Button
    {
        $keyName = $this->grid->getPrimaryKey();
        $api = $this->grid->getDestroyUrl('${' . $keyName . '}');
        return AjaxAction::make()->label("删除")
            ->level("link")->confirmText("确定要删除？")->api($api)->className('text-danger')->icon('fa fa-trash-can icon-mr');
    }

    /**
     * 自定义删除操作
     * @param Closure $closure
     * @return void
     */
    public function callDeleteAction(Closure $closure): void
    {
        $this->callDeleteActionFun = $closure;
    }

    private function buildEditAction(): Button
    {
        $keyName = $this->grid->getPrimaryKey();
        if ($this->grid->isDialogForm()) {
            $api = 'get:' . $this->grid->getEditUrl($keyName) . '?_dialog=1';
            return $this->grid->renderDialogForm($api, true);
        }
        $api = admin_route($this->grid->getEditUrl($keyName));
        return LinkAction::make()->label("编辑")->level("link")->link($api)->icon('fa fa-edit icon-mr');
    }

    /**
     * 自定义编辑操作
     * @param Closure $closure
     * @return void
     */
    public function callEditAction(Closure $closure): void
    {
        $this->callEditActionFun = $closure;
    }

    /**
     * 使用鼠标悬浮显示操作栏
     * @param bool $hoverAction
     * @return Actions
     */
    public function hoverAction(bool $hoverAction = true): self
    {
        $this->hoverAction = $hoverAction;
        $this->rowAction = true;
        return $this;
    }

    /**
     * @return bool
     */
    public function isHoverAction(): bool
    {
        return $this->hoverAction;
    }

    /**
     * @return bool
     */
    public function isRowAction(): bool
    {
        return $this->rowAction;
    }

    /**
     * 使用行内操作栏
     * @param bool $rowAction
     * @return Actions
     */
    public function rowAction(bool $rowAction = true): Actions
    {
        $this->rowAction = $rowAction;
        return $this;
    }


    /**
     * @return float|int|string
     */
    public function getWidth(): float|int|string
    {
        return $this->width;
    }

    /**
     * 设置操作栏宽度，悬浮显示操作栏不生效
     * @param float|int|string $width
     * @return Actions
     */
    public function width(float|int|string $width): Actions
    {
        $this->width = $width;
        return $this;
    }


    /**
     * 禁用删除按钮
     * @return void
     */
    public function disableDelete(): void
    {
        $this->disableDeleteAction = true;
    }

    /**
     * 禁用编辑按钮
     * @return void
     */
    public function disableEdit(): void
    {
        $this->disableEditAction = true;
    }

    private function initAction(): array
    {
        $actions = collect([]);

        if (!$this->disableEditAction) {
            $editAction = $this->buildEditAction();
            if ($this->callEditActionFun) {
                call_user_func($this->callEditActionFun, $editAction);
            }
            $actions->add($editAction);
        }
        if (!$this->disableDeleteAction) {
            $deleteAction = $this->buildDeleteAction();
            if ($this->callDeleteActionFun) {
                call_user_func($this->callDeleteActionFun, $deleteAction);
            }
            $actions->add($deleteAction);
        }

        return $actions->toArray();
    }


    /**
     * 前置添加操作
     * @param $node
     * @return $this
     */
    public function prepend($node): self
    {
        $this->prependList[] = $node;
        return $this;
    }

    /**
     * 后置添加操作
     * @param $node
     * @return $this
     */
    public function add($node): self
    {
        $this->addList[] = $node;
        return $this;
    }

    /**
     * render
     * @return array
     */
    public function render(): array
    {
        $res = collect([]);
        foreach ($this->prependList as $node) {
            $res->prepend($node);
        }
        foreach ($this->initAction() as $node) {
            $res->add($node);
        }
        foreach ($this->addList as $node) {
            $res->add($node);
        }
        if ($this->isRowAction()) {
            return $res->toArray();
        }
        return [DropdownButton::make()->hideCaret(true)->size("sm")->icon('fa fa-ellipsis-h')->level('link')->buttons($res->toArray())];


    }
}
