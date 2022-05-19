<?php

namespace SmallRuralDog\AmisAdmin\Renderers\Table;

use SmallRuralDog\AmisAdmin\Renderers\BaseSchema;

/**
 * 表格列，不指定类型时默认为文本类型。
 * @method $this label($v)
 * @method $this fixed($v)
 * @method $this name($v)
 * @method $this popOver($v)
 * @method $this quickEdit($v)
 * @method $this quickEditOnUpdate($v)
 * @method $this copyable($v)
 * @method $this sortable($v)
 * @method $this searchable($v)
 * @method $this toggled($v)
 * @method $this width($v)
 * @method $this align($v)
 * @method $this className($v)
 * @method $this classNameExpr($v)
 * @method $this labelClassName($v)
 * @method $this filterable($v)
 * @method $this breakpoint($v)
 * @method $this remark($v)
 * @method $this value($v)
 * @method $this unique($v)
 */
class TableColumn extends BaseSchema
{
    public string $type = 'text';

}
