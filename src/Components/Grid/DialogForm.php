<?php

namespace SmallRuralDog\AmisAdmin\Components\Grid;

use SmallRuralDog\AmisAdmin\Components\Grid;
use SmallRuralDog\AmisAdmin\Renderers\Action\DialogAction;
use SmallRuralDog\AmisAdmin\Renderers\Service;
use SmallRuralDog\AmisAdmin\Renderers\Wrapper;

class DialogForm
{

    protected Grid $grid;

    protected DialogAction $createDialogAction;
    protected DialogAction $editDialogAction;

    protected mixed $size = null;

    public function __construct(Grid $grid)
    {
        $this->grid = $grid;
        $this->createDialogAction = DialogAction::make()->label("新增")->level('primary')->icon('fa fa-add');
        $this->editDialogAction = DialogAction::make()->label("编辑")->level('link')->icon('fa fa-edit icon-mr');
    }

    /**
     * 设置弹窗大小
     * @param mixed $size
     * @return DialogForm
     */
    public function size(mixed $size): DialogForm
    {
        $this->size = $size;
        return $this;
    }

    /**
     * 较小的弹框
     * @return void
     */
    public function sm(): void
    {
        $this->size("sm");
    }

    /**
     * 较大的弹框
     * @return void
     */
    public function lg(): void
    {
        $this->size("lg");
    }

    /**
     * 很大的弹框
     * @return void
     */
    public function xl(): void
    {
        $this->size("xl");
    }

    /**
     * 占满屏幕的弹框
     * @return void
     */
    public function full(): void
    {
        $this->size("full");
    }

    /**
     * 渲染弹窗
     * @param $api
     * @param bool $edit
     * @return DialogAction
     */
    public function render($api, bool $edit = false): DialogAction
    {

        if ($edit) {
            $this->editDialogAction->dialog([
                'title' => '编辑',
                'size' => $this->size,
                'body' => Service::make()->schemaApi($api),
            ]);
            return $this->editDialogAction;
        }
        $this->createDialogAction->dialog([
            'title' => '新增',
            'size' => $this->size,
            'body' => Service::make()->schemaApi($api),
        ]);
        return $this->createDialogAction;
    }
}
