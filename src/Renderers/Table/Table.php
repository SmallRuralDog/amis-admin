<?php

namespace SmallRuralDog\AmisAdmin\Renderers\Table;

use SmallRuralDog\AmisAdmin\Renderers\BaseSchema;

/**
 * 数据表渲染器
 * @method $this affixHeader($v)
 * @method $this columns($v)
 * @method $this columnsTogglable($v)
 * @method $this footable($v)
 * @method $this footerClassName($v)
 * @method $this headerClassName($v)
 * @method $this placeholder($v)
 * @method $this showFooter($v)
 * @method $this showHeader($v)
 * @method $this source($v)
 * @method $this tableClassName($v)
 * @method $this title($v)
 * @method $this toolbarClassName($v)
 * @method $this combineNum($v)
 * @method $this combineFromIndex($v)
 * @method $this prefixRow($v)
 * @method $this affixRow($v)
 * @method $this resizable($v)
 * @method $this rowClassNameExpr($v)
 * @method $this itemBadge($v)
 * @method $this autoGenerateFilter($v)
 */
class Table extends BaseSchema
{
    public string $type = 'table';

}
