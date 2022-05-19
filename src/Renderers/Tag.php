<?php

namespace SmallRuralDog\AmisAdmin\Renderers;

/**
 * @method $this className($v)
 * @method $this style($v)
 * @method $this color($v)
 * @method $this label($v)
 * @method $this displayMode($v)
 * @method $this icon($v)
 * @method $this closable($v)
 * @method $this closeIcon($v)
 * @method $this checkable($v)
 * @method $this checked($v)
 * @method $this disabled($v)
 */
class Tag extends BaseSchema
{
    public string $type = 'tag';
}
