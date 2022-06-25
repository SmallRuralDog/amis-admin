<?php

namespace SmallRuralDog\AmisAdmin\Renderers\Form;

/**
 * Select渲染器
 * @method $this autoComplete($v)
 * @method $this menuTpl($v)
 * @method $this borderMode($v)
 * @method $this selectMode($v)
 * @method $this leftOptions($v)
 * @method $this leftMode($v)
 * @method $this rightMode($v)
 * @method $this searchResultMode($v)
 * @method $this columns($v)
 * @method $this searchResultColumns($v) 当 searchResultMode 为 table 时定义表格列信息。
 * @method $this searchable($v) 可搜索？
 * @method $this searchApi($v) 搜索 API
 */
class Select extends FormOptions
{
    public string $type = 'select';
}
