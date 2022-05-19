<?php

namespace SmallRuralDog\AmisAdmin\Renderers;

/**
 * @method $this key($v)
 * @method $this headerPosition($v)
 * @method $this header($v)
 * @method $this body($v)
 * @method $this bodyClassName($v)
 * @method $this disabled($v)
 * @method $this collapsable($v)
 * @method $this collapsed($v)
 * @method $this showArrow($v)
 * @method $this expandIcon($v)
 * @method $this headingClassName($v)
 * @method $this collapseHeader($v)
 * @method $this size($v)
 * @method $this mountOnEnter($v)
 * @method $this unmountOnExit($v)
 */
class Collapse extends BaseSchema
{
    public string $type = 'collapse';
}
