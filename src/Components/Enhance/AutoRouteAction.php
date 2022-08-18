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
    public function action(string $actionName, array $params = [], array $data = [], string $method = "post"): array
    {
        $class = Crypt::encryptString($this::class);
        $d = [
            'class' => $class,
            'action' => $actionName,
            'data' => $data,
            'params' => $params,
            '_token' => csrf_token(),
        ];
        return [
            'method' => $method,
            "url" => urldecode(route_get('amis-admin.handle-action', $params)),
            "data" => $d,
        ];
    }
}
