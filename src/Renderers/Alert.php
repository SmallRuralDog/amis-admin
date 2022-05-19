<?php

namespace SmallRuralDog\AmisAdmin\Renderers;

/**
 * Alert 提示渲染器。
 * @method self title($v)
 * @method self body($v)
 * @method self level($v)
 * @method self showCloseButton($v)
 * @method self closeButtonClassName($v)
 * @method self showIcon($v)
 * @method self icon($v)
 * @method self iconClassName($v)
 */
class Alert extends BaseSchema
{
    public string $type = 'alert';

}
