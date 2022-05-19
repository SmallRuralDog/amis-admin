<?php

namespace SmallRuralDog\AmisAdmin\Renderers;

/**
 * @method $this className($v)
 * @method $this name($v)
 * @method $this placeholder($v)
 * @method $this mini($v)
 * @method $this searchImediately($v)
 */
class SearchBox extends BaseSchema
{
    public string $type = 'search-box';
}
