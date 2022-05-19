<?php

namespace SmallRuralDog\AmisAdmin\Components\Grid;

trait GridActions
{

    protected Actions $actions;

    //禁用操作
    protected bool $disableAction = false;

    /**
     * 禁用所有操作
     * @return $this
     */
    public function disableAction(): self
    {
        $this->disableAction = true;
        return $this;
    }

    /**
     * 禁用删除
     * @return $this
     */
    public function disableDelete(): self
    {
        $this->actions->disableDelete();
        return $this;
    }

    /**
     * 禁用编辑
     * @return $this
     */
    public function disableEdit(): self
    {
        $this->actions->disableEdit();
        return $this;
    }

    /**
     * 禁用批量删除
     * @param bool $bool
     * @return self
     */
    public function disableBulkDelete(bool $bool = true): self
    {
        $this->toolbar->disableBulkDelete($bool);
        return $this;
    }

    /**
     * 行操作
     * @param $fun
     * @return self
     */
    public function actions($fun): self
    {
        $fun($this->actions);
        return $this;
    }

    public function renderAction(): array
    {
        return $this->actions->render();
    }
}
