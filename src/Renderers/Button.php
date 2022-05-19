<?php

namespace SmallRuralDog\AmisAdmin\Renderers;

/**
 * @method $this id($v)
 * @method $this block($v)
 * @method $this disabledTip($v)
 * @method $this icon($v)
 * @method $this align($v)
 * @method $this iconClassName($v)
 * @method $this rightIcon($v)
 * @method $this rightIconClassName($v)
 * @method $this loadingClassName($v)
 * @method $this label($v)
 * @method $this level($v)
 * @method $this primary($v)
 * @method $this size($v)
 * @method $this tooltip($v)
 * @method $this tooltipPlacement($v)
 * @method $this type($v)
 * @method $this confirmText($v)
 * @method $this required($v)
 * @method $this activeLevel($v)
 * @method $this activeClassName($v)
 * @method $this close($v)
 * @method $this requireSelected($v)
 * @method $this mergeData($v)
 * @method $this target($v)
 * @method $this countDown($v)
 * @method $this countDownTpl($v)
 * @method $this badge($v)
 * @method $this hotKey($v)
 * @method $this loadingOn($v)
 * @method $this onClick($v)
 * @method $this body($v)
 */
class Button extends BaseSchema
{
    public string $type = 'button';
}
