<?php

namespace SmallRuralDog\AmisAdmin\Renderers\Action;

use SmallRuralDog\AmisAdmin\Renderers\Button;

/**
 * @method $this dialog($v)
 * @method $this nextCondition($v)
 * @method $this reload($v)
 * @method $this redirect($v)
 */
class DialogAction extends Button
{
    public string $actionType = 'dialog';
}
