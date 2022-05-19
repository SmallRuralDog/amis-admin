<?php

namespace SmallRuralDog\AmisAdmin\Renderers;

/**
 * @method $this label($v)
 * @method $this icon($v)
 * @method $this tooltipClassName($v)
 * @method $this trigger($v)
 * @method $this title($v)
 * @method $this content($v)
 * @method $this placement($v)
 * @method $this rootClose($v)
 * @method $this shape($v)
 */
class Remark extends BaseSchema
{
    public string $type = 'remark';
}
