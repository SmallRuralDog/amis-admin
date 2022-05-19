<?php

namespace SmallRuralDog\AmisAdmin\Renderers;

/**
 * 模板渲染器
 * @method  self tpl($v)
 * @method  self html($v)
 * @method  self text($v)
 * @method  self raw($v)
 * @method  self inline($v)
 * @method  self style($v)
 * @method  self badge($v)
 */
class Tpl extends BaseSchema
{
    public string $type = 'tpl';

}
