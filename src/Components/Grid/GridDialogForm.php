<?php

namespace SmallRuralDog\AmisAdmin\Components\Grid;

use Closure;
use SmallRuralDog\AmisAdmin\Renderers\Action\DialogAction;

trait GridDialogForm
{

    protected bool $isDialogForm = false;

    protected DialogForm $dialogForm;


    /**
     * 弹窗表单模式
     * @param string|null $size xs、sm、md、lg、xl、full
     * @param Closure|null $closure
     * @return void
     */
    public function dialogForm(string $size = null, Closure $closure = null): void
    {
        $this->isDialogForm = true;

        $this->dialogForm = new DialogForm($this);

        $this->dialogForm->size($size);

        if ($closure) $closure($this->dialogForm);
    }

    public function renderDialogForm($api, $edit = false): DialogAction
    {
        return $this->dialogForm->render($api, $edit);
    }

    public function isDialogForm(): bool
    {
        return $this->isDialogForm;
    }
}
