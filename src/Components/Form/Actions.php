<?php

namespace SmallRuralDog\AmisAdmin\Components\Form;

use SmallRuralDog\AmisAdmin\Components\Form;
use SmallRuralDog\AmisAdmin\Renderers\Button;

class Actions
{

    protected bool $disableSubmitAction = false;
    protected bool $disableResetAction = false;

    protected array $prependList = [];
    protected array $addList = [];

    public function __construct(protected Form $form)
    {
    }


    private function buildSubmitAction(): Button
    {
        return Button::make()->type("submit")->label("提交")->level("primary");
    }

    private function buildResetAction(): Button
    {

        return Button::make()->type("reset")->label("重置");
    }

    /**
     * 禁用提交
     * @return $this
     */
    public function disableSubmit(bool $disable = true): self
    {
        $this->disableSubmitAction = $disable;
        return $this;
    }

    /**
     * 禁用重置
     * @return $this
     */
    public function disableReset(bool $disable = true): self
    {
        $this->disableResetAction = $disable;
        return $this;
    }

    private function initAction(): array
    {
        $actions = collect([]);

        if (!$this->disableResetAction) {
            $actions->add($this->buildResetAction());
        }

        if (!$this->disableSubmitAction) {
            $actions->add($this->buildSubmitAction());
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
        return $res->toArray();
    }
}
