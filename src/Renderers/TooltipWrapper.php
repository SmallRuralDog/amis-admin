<?php

namespace SmallRuralDog\AmisAdmin\Renderers;

/**
 * @method $this title($v)
 * @method $this content($v)
 * @method $this tooltip($v)
 * @method $this placement($v)
 * @method $this offset($v)
 * @method $this showArrow($v)
 * @method $this disabled($v)
 * @method $this trigger($v)
 * @method $this mouseEnterDelay($v)
 * @method $this mouseLeaveDelay($v)
 * @method $this rootClose($v)
 * @method $this body($v)
 * @method $this wrapperComponent($v)
 * @method $this inline($v)
 * @method $this tooltipTheme($v)
 * @method $this style($v)
 * @method $this enterable($v)
 * @method $this tooltipStyle($v)
 * @method $this className($v)
 * @method $this tooltipClassName($v)
 */
class TooltipWrapper extends BaseSchema
{
    public string $type = 'tooltip-wrapper';
}
