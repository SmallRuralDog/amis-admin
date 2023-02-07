<?php

namespace SmallRuralDog\AmisAdmin\Renderers;

use SmallRuralDog\AmisAdmin\Renderers\Table\Table;

/**
 * CRUD 渲染器
 * @method $this mode($v)
 * @method $this api($v)
 * @method $this bulkActions($v)
 * @method $this itemActions($v)
 * @method $this perPage($v)
 * @method $this orderBy($v)
 * @method $this orderDir($v)
 * @method $this defaultParams($v)
 * @method $this draggable($v)
 * @method $this draggableOn($v)
 * @method $this name($v)
 * @method $this filter($v)
 * @method $this initFetch($v)
 * @method $this initFetchOn($v)
 * @method $this innerClassName($v)
 * @method $this interval($v)
 * @method $this orderField($v)
 * @method $this pageField($v)
 * @method $this perPageField($v)
 * @method $this quickSaveApi($v)
 * @method $this quickSaveItemApi($v)
 * @method $this saveOrderApi($v)
 * @method $this syncLocation($v)
 * @method $this headerToolbar($v)
 * @method $this footerToolbar($v)
 * @method $this perPageAvailable($v)
 * @method $this messages($v)
 * @method $this hideQuickSaveBtn($v)
 * @method $this autoJumpToTopOnPagerChange($v)
 * @method $this silentPolling($v)
 * @method $this stopAutoRefreshWhen($v)
 * @method $this stopAutoRefreshWhenModalIsOpen($v)
 * @method $this filterTogglable($v)
 * @method $this filterDefaultVisible($v)
 * @method $this syncResponse2Query($v)
 * @method $this keepItemSelectionOnPageChange($v)
 * @method $this labelTpl($v)
 * @method $this loadDataOnce($v)
 * @method $this loadDataOnceFetchOnFilter($v)
 * @method $this source($v)
 * @method $this expandConfig($v) 如果时内嵌模式，可以通过这个来配置默认的展开选项。
 * @method $this alwaysShowPagination($v)
 * @method $this autoGenerateFilter($v)
 * @method $this autoFillHeight($v)
 * @method $this primaryField($v)
 */
class CRUD extends Table
{
    public string $type = 'crud';

}
