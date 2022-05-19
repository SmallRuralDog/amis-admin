<?php

namespace SmallRuralDog\AmisAdmin\Renderers;

/**
 * @method $this layout($v)
 * @method $this maxButtons($v)
 * @method $this mode($v)
 * @method $this activePage($v)
 * @method $this total($v)
 * @method $this lastPage($v)
 * @method $this perPage($v)
 * @method $this showPerPage($v)
 * @method $this perPageAvailable($v)
 * @method $this showPageInput($v)
 * @method $this disabled($v)
 * @method $this hasNext($v)
 */
class Pagination extends BaseSchema
{
    public string $type = 'pagination';
}
