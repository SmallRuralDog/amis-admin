<?php

namespace SmallRuralDog\AmisAdmin\Components\Grid;

use SmallRuralDog\AmisAdmin\Components\Grid;

trait GridTree
{
    private bool $toTree = false;
    private ?string $toTreeKey = null;
    private string $toTreeParentKey = "parent_id";
    private string $toTreeChildrenName = "parent_id";


    /**
     * @return bool
     */
    public function isToTree(): bool
    {
        return $this->toTree;
    }

    /**
     * @return string
     */
    public function getToTreeKey(): string
    {
        if ($this->toTreeKey) {
            return $this->toTreeKey;
        }
        return $this->builder()->getModel()->getKeyName();
    }


    /**
     * @return string
     */
    public function getToTreeParentKey(): string
    {
        return $this->toTreeParentKey;
    }

    /**
     * @return string
     */
    public function getToTreeChildrenName(): string
    {
        return $this->toTreeChildrenName;
    }

    /**
     * 嵌套数据模式
     * @param string|null $toTreeKey
     * @param string $toTreeParentKey
     * @param string $toTreeChildrenName
     * @return Grid|GridTree
     */
    public function toTree(string $toTreeKey = null, string $toTreeParentKey = "parent_id", string $toTreeChildrenName = "children"): self
    {
        if (!$toTreeKey) {
            $toTreeKey = $this->builder()->getModel()->getKeyName();
        }
        $this->toTree = true;
        $this->toTreeKey = $toTreeKey;
        $this->toTreeParentKey = $toTreeParentKey;
        $this->toTreeChildrenName = $toTreeChildrenName;
        return $this;
    }

}
