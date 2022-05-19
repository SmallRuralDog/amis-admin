<?php

namespace SmallRuralDog\AmisAdmin\Renderers\Action;

use SmallRuralDog\AmisAdmin\Renderers\Button;

/**
 * @method $this blank($v)
 * @method $this url($v)
 */
class UrlAction extends Button
{
    public string $actionType = 'url';
}
