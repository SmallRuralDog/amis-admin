<?php

namespace SmallRuralDog\AmisAdmin\Renderers;

/**
 * @method $this actions($v)
 * @method $this body($v)
 * @method $this className($v)
 * @method $this bodyClassName($v)
 * @method $this headerClassName($v)
 * @method $this footerClassName($v)
 * @method $this closeOnEsc($v)
 * @method $this name($v)
 * @method $this size($v)
 * @method $this title($v)
 * @method $this position($v)
 * @method $this showCloseButton($v)
 * @method $this width($v)
 * @method $this height($v)
 * @method $this header($v)
 * @method $this footer($v)
 * @method $this confirm($v)
 * @method $this resizable($v)
 * @method $this overlay($v)
 * @method $this closeOnOutside($v)
 * @method $this showErrorMsg($v)
 */
class Drawer extends BaseSchema
{
    public string $type = 'drawer';
}
