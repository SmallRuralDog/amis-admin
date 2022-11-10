<?php

namespace SmallRuralDog\AmisAdmin\Components\Grid;

use Closure;
use SmallRuralDog\AmisAdmin\Components\Form\Item;
use SmallRuralDog\AmisAdmin\Renderers\Button;
use SmallRuralDog\AmisAdmin\Renderers\Form\AmisForm;

/**
 * @method $this title($v)
 * @method $this submitText($v)
 * @method $this columnCount($v)
 * @method $this body($v)
 */
class Filter extends AmisForm
{
    private array $filterItems = [];
    private array $filterField = [];
    private array $defaultValue = [];

    public function __construct()
    {
        parent::__construct();
        $this->title("搜索");
        $this->submitText("");
        $this->mode("inline")->wrapWithPanel(false)->className('mb-3 bg-search px-2 pt-3');
    }

    protected function addItem($name = '', $label = ''): Item
    {
        $searchName = "search.$name";

        $item = new Item($searchName, $label);
        $item->size('md');
        $this->filterItems[] = $item;
        return $item;
    }

    private function addField($field, $type, Closure $fun = null): void
    {
        $item = [
            'field' => $field,
            'type' => $type,
            'fun' => $fun
        ];
        $this->filterField[] = $item;
    }

    public function getFilterField(): array
    {
        return $this->filterField;
    }

    public function renderBody(): array
    {
        $items = [];
        if (count($this->filterField) > 0) {
            foreach ($this->filterItems as $item) {
                /**@var Item $item */
                $items[] = $item->render();
            }
            $items[] = Button::make()->label("搜索")->type("submit")->level("primary");
            $items[] = Button::make()->label("重置")->type("reset");
        }
        return $items;
    }

    /**
     * 设置搜索表单默认值
     * @param array $defaultValue
     * @return Filter
     */
    public function defaultValue(array $defaultValue): Filter
    {
        foreach ($defaultValue as $key => $value) {
            $this->defaultValue["search"][$key] = $value;
        }
        return $this;
    }


    /**
     * @return array
     */
    public function getDefaultValue(): array
    {
        return $this->defaultValue;
    }

    public function where($name, $label = '', Closure $fun = null): Item
    {
        $this->addField($name, 'where', $fun);
        return $this->addItem($name, $label);
    }

    public function eq($name, $label = ''): Item
    {
        $this->addField($name, 'eq');
        return $this->addItem($name, $label);
    }

    public function like($name, $label): Item
    {
        $this->addField($name, 'like');
        return $this->addItem($name, $label);
    }

    public function between($name, $label): Item
    {
        $this->addField($name, 'between');
        return $this->addItem($name, $label);
    }

    public function in($name, $label): Item
    {
        $this->addField($name, 'in');
        return $this->addItem($name, $label);
    }

    public function notIn($name, $label): Item
    {
        $this->addField($name, 'notIn');
        return $this->addItem($name, $label);
    }

}
