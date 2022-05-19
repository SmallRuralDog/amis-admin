<?php

namespace SmallRuralDog\AmisAdmin\Renderers\Action;

use SmallRuralDog\AmisAdmin\Renderers\Button;

/**
 * @method $this drawer($v)
 * @method $this nextCondition($v)
 * @method $this reload($v)
 * @method $this redirect($v)
 */
class DrawerAction extends Button
{
    public string $actionType = 'drawer';
}
