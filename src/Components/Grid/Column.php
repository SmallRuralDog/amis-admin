<?php

namespace SmallRuralDog\AmisAdmin\Components\Grid;

use Closure;
use SmallRuralDog\AmisAdmin\Renderers\Table\TableColumn;

/**
 * @method $this type($v)
 * @method $this fixed($v) 配置是否固定当前列 'left' | 'right' | 'none'
 * @method $this popOver($v) 配置查看详情功能
 * @method $this quickEdit($v) 配置快速编辑功能
 * @method $this quickEditOnUpdate($v) 作为表单项时，可以单独配置编辑时的快速编辑面板。
 * @method $this copyable($v) 配置点击复制功能
 * @method $this sortable($v) 配置是否可以排序
 * @method $this searchable($v) 是否可快速搜索
 * @method $this toggled($v) 配置是否默认展示
 * @method $this width($v) 列宽度
 * @method $this align($v) 列对齐方式 'left' | 'right' | 'center' | 'justify'
 * @method $this className($v) 列样式表
 * @method $this classNameExpr($v) 单元格样式表达式
 * @method $this labelClassName($v) 列头样式表
 * @method $this filterable($v) todo
 * @method $this breakpoint($v) 结合表格的 footable 一起使用。填写 *、xs、sm、md、lg指定 footable 的触发条件，可以填写多个用空格隔开
 * @method $this remark($v) 提示信息
 * @method $this value($v) 默认值, 只有在 inputTable 里面才有用
 * @method $this unique($v) 是否唯一, 只有在 inputTable 里面才有用
 */
class Column
{

    protected string $label;
    protected string $name;

    protected TableColumn $tableColumn;

    public function __construct($name, $label)
    {

        if (empty($label)) {
            $label = $name;
        }
        $this->label = $label;
        $this->name = $name;
        $this->tableColumn = TableColumn::make()->name($name)->label($label);
    }


    public function __call($name, $arguments)
    {
        $this->tableColumn->$name(...$arguments);
        return $this;
    }


    /**
     * @param $typeComponent
     * @return TableColumn
     */
    public function useTableColumn($typeComponent = null): TableColumn
    {
        if ($typeComponent) {
            if ($typeComponent instanceof Closure) {
                $typeComponent = $typeComponent();
            }
            foreach ($typeComponent as $key => $value) {
                $this->tableColumn->$key($value);
            }
        }
        return $this->tableColumn;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function render(): TableColumn
    {
        return $this->tableColumn;
    }
}
