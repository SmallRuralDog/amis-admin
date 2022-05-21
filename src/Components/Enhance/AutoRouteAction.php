<?php

namespace SmallRuralDog\AmisAdmin\Components\Enhance;

use Crypt;

trait AutoRouteAction
{

    /**
     * API 配置对象类型
     *
     * https://aisuda.bce.baidu.com/amis/zh-CN/docs/types/api#%E5%A4%8D%E6%9D%82%E9%85%8D%E7%BD%AE
     * @param string $actionName
     * @param array $params
     * @param string $method
     * @return array
     */
    public function action(string $actionName, array $params = [], string $method = "post"): array
    {
        $class = Crypt::encryptString($this::class);
        $data = [
            'class' => $class,
            'action' => $actionName,
            'params' => $params
        ];
        return [
            'method' => $method,
            "url" => route('amis-admin.handle-action'),
            "data" => $data,
        ];
    }
}
