<?php

namespace SmallRuralDog\AmisAdmin\Components\Grid;


use SmallRuralDog\AmisAdmin\Components\Grid;

trait GridFilter
{

    private Filter $filter;

    /**
     * 查询过滤器
     * @param $fun
     * @return Grid
     */
    public function filter($fun): Grid
    {
        $this->crud->filterTogglable(true);
        $fun($this->filter);
        return $this;
    }

    public function getFilterField(): array
    {
        return $this->filter->getFilterField();
    }


    private function buildFilter(): void
    {
        $this->filter->body($this->filter->renderBody());
    }

    private function renderFilter()
    {
        $this->buildFilter();

        return $this->filter;
    }
}
