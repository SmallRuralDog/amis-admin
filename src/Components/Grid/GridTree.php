<?php

namespace SmallRuralDog\AmisAdmin\Components\Grid;

trait GridTree
{
    private bool $toTree = false;
    private string $toTreeKey = "id";
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
        return $this->toTreeKey;
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
     * @param string $toTreeKey
     * @param string $toTreeParentKey
     * @param string $toTreeChildrenName
     * @return self
     */
    public function toTree(string $toTreeKey = "id", string $toTreeParentKey = "parent_id", string $toTreeChildrenName = "children"): self
    {
        $this->toTree = true;
        $this->toTreeKey = $toTreeKey;
        $this->toTreeParentKey = $toTreeParentKey;
        $this->toTreeChildrenName = $toTreeChildrenName;
        return $this;
    }

}
