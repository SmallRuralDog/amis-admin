<?php

namespace SmallRuralDog\AmisAdmin\Components\Grid;

use Closure;

trait GridData
{

    public ?Closure $callRows = null;
    public ?Closure $callRow = null;

    /**
     * 处理数据集合
     * @param Closure $closure
     * @return $this
     */
    public function useRows(Closure $closure): self
    {
        $this->callRows = $closure;
        return $this;
    }

    /**
     * 处理每一条数据
     * @param Closure $closure
     * @return $this
     */
    public function useRow(Closure $closure): self
    {
        $this->callRow = $closure;
        return $this;
    }

    protected function buildData(): array
    {

        return $this->model->buildData();
    }
}
