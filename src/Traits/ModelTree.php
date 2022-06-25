<?php

namespace SmallRuralDog\AmisAdmin\Traits;

trait ModelTree
{

    public static function getTreeSelectList($keyColumn = "id", $valueColumn = "title", $orderColumn = "order", $hasTop = false): array
    {
        $list = self::query()->orderBy($orderColumn)->get()->toArray();
        if ($hasTop) {
            $list = [
                ['_id' => '0', $valueColumn => '顶级菜单', 'children' => arr2tree($list, $keyColumn)],
            ];
        }
        return arr2tree($list, $keyColumn);
    }
}
