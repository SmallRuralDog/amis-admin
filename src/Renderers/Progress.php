<?php

namespace SmallRuralDog\AmisAdmin\Renderers;

/**
 * @method $this name($v)
 * @method $this mode($v)
 * @method $this progressClassName($v)
 * @method $this map($v)
 * @method $this showLabel($v)
 * @method $this placeholder($v)
 * @method $this stripe($v)
 * @method $this animate($v)
 * @method $this strokeWidth($v)
 * @method $this gapDegree($v)
 * @method $this gapPosition($v)
 * @method $this valueTpl($v)
 * @method $this value($v)
 */
class Progress extends BaseSchema
{
    public string $type = 'progress';
}
