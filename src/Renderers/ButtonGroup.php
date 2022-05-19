<?php

namespace SmallRuralDog\AmisAdmin\Renderers;

/**
 * @method $this btnClassName($v)
 * @method $this btnActiveClassName($v)
 * @method $this buttons($v)
 * @method $this btnLevel($v)
 * @method $this btnActiveLevel($v)
 * @method $this vertical($v)
 * @method $this tiled($v)
 * @method $this disabled($v)
 * @method $this visible($v)
 * @method $this visibleOn($v)
 * @method $this size($v)
 */
class ButtonGroup extends BaseSchema
{
    public string $type = 'button-group';
}
