<?php

namespace SmallRuralDog\AmisAdmin\Components\Form;

use Closure;

trait FormActions
{

    protected Actions $actions;

    //禁用操作
    protected bool $disableAction = false;

    /**
     * 表单自定义操作
     * @param Closure $fun
     * @return FormActions|\SmallRuralDog\AmisAdmin\Components\Form
     */
    public function actions(Closure $fun): self
    {
        $fun($this->actions);
        return $this;
    }

    /**
     * 禁用所有操作
     * @return $this
     */
    public function disableAction(): self
    {
        $this->disableAction = true;
        return $this;
    }
}
