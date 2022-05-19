<?php

namespace SmallRuralDog\AmisAdmin\Components\Form;

use SmallRuralDog\AmisAdmin\Components\Grid\GridActions;

trait FormActions
{

    protected Actions $actions;

    //禁用操作
    protected bool $disableAction = false;

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
