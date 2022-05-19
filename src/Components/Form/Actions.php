<?php

namespace SmallRuralDog\AmisAdmin\Components\Form;

use SmallRuralDog\AmisAdmin\Components\Form;
use SmallRuralDog\AmisAdmin\Renderers\Button;

class Actions
{

    protected bool $disableSubmitAction = false;
    protected bool $disableResetAction = false;

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
     * render
     * @return array
     */
    public function render(): array
    {
        $res = collect([]);

        foreach ($this->initAction() as $node) {
            $res->add($node);
        }

        return $res->toArray();
    }
}
