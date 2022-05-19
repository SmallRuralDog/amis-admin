<?php

namespace SmallRuralDog\AmisAdmin\Renderers;

/**
 * @method $this title($v)
 * @method $this column($v)
 * @method $this mode($v)
 * @method $this items($v)
 * @method $this style($v)
 * @method $this titleStyle($v)
 * @method $this labelStyle($v)
 * @method $this separator($v)
 * @method $this contentStyle($v)
 */
class Property extends BaseSchema
{
    public string $type = 'property';
}
