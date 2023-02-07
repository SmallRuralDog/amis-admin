<?php

namespace SmallRuralDog\AmisAdmin\Components\Grid;

use Closure;
use SmallRuralDog\AmisAdmin\Renderers\BaseSchema;
use SmallRuralDog\AmisAdmin\Renderers\Date;
use SmallRuralDog\AmisAdmin\Renderers\Each;
use SmallRuralDog\AmisAdmin\Renderers\Flex;
use SmallRuralDog\AmisAdmin\Renderers\Image;
use SmallRuralDog\AmisAdmin\Renderers\Mapping;
use SmallRuralDog\AmisAdmin\Renderers\Status;
use SmallRuralDog\AmisAdmin\Renderers\Tpl;

trait ColumnDisplay
{

    /**
     * 图片渲染
     * @param int $w
     * @param int $h
     * @param Closure<Image>|null $closure
     * @return ColumnDisplay|Column
     */
    public function image(int $w = 80, int $h = 80, Closure $closure = null): self
    {
        $image = Image::make()->width($w)->height($h);
        if ($closure) {
            $closure($image);
        }
        $this->useTableColumn($image);
        return $this;
    }

    /**
     * 标签渲染
     * @param string $type
     * @param string $size
     * @param Closure<Tpl>|null $closure
     * @return ColumnDisplay|Column
     */
    public function label(string $type = 'info', string $size = 'sm', Closure $closure = null): self
    {
        $tpl = Tpl::make()->tpl("<span class='label label-{$type} label-{$size} m-r-sm'><%= this.{$this->name} %></span>");
        if ($closure) {
            $closure($tpl);
        }
        $this->useTableColumn($tpl);
        return $this;
    }

    /**
     * 循环渲染
     * @param Closure<Each>|null $closure
     * @return ColumnDisplay|Column
     */
    public function each(Closure $closure = null): self
    {
        $each = Each::make();
        $each->placeholder('暂无数据');

        $each->items(Tpl::make()->tpl("<span class='label label-info m-r-sm'><%= this.item %></span>"));

        if ($closure) {
            $closure($each);
        }
        $this->useTableColumn($each);
        return $this;

    }

    /**
     * 日期渲染
     * @param Closure<Date>|null $closure
     * @return $this
     */
    public function date(Closure $closure = null)
    {
        $date = Date::make();
        if ($closure) {
            $closure($date);
        }
        $this->useTableColumn($date);
        return $this;
    }

    /**
     * 状态渲染
     * @param Closure<Status>|null $closure
     * @return ColumnDisplay|Column
     */
    public function status(Closure $closure = null): self
    {
        $status = Status::make();
        if ($closure) {
            $closure($status);
        }
        $this->useTableColumn($status);
        return $this;
    }

    /**
     * 数字渲染
     */
    public function number($numDigits = 2, $suffix = ""): self
    {
        $this->useTableColumn(Tpl::make()->tpl("\${FLOOR({$this->name},$numDigits)} $suffix"));
        return $this;
    }

    /**
     * mapping 映射渲染
     */
    public function mapping(array $map): self
    {
        $mapping = Mapping::make();

        $mapping->map($map);

        $this->useTableColumn($mapping);
        return $this;
    }

    /**
     * 多个字段显示
     */
    public function multipleDisplay(array $items = [], $column = true, Closure $closure = null)
    {

        $flex = Flex::make()->items($items);
        if ($column) {
            $flex->direction("column");
        }
        if ($closure) {
            $closure($flex);
        }
        $items = data_get($flex, "items");


        $newItems = array();

        foreach ($items as $key => $item) {
            if ($key <= 0) {
                $newItems[] = $item;
                continue;
            }
            if ($item instanceof BaseSchema && !property_exists($item, "className")) {
                $item->className("mt-1");
            }
            $newItems[] = $item;
        }
        $flex->items($newItems);

        $this->useTableColumn($flex);
        return $this;
    }

}
