<?php

namespace SmallRuralDog\AmisAdmin\Renderers;

/**
 * Date 展示渲染器。
 * @method $this type($v) 'date'| 'datetime'| 'time'| 'static-date'| 'static-datetime'| 'static-time'
 * @method $this format($v) 展示的时间格式，参考 moment 中的格式说明。
 * @method $this placeholder($v)
 * @method $this valueFormat($v)
 * @method $this fromNow($v)
 * @method $this updateFrequency($v)
 */
class Date extends BaseSchema
{
    public string $type = 'date';

    public function datetime(): Date
    {
        $this->type = 'datetime';
        return $this;
    }

    public function time(): Date
    {
        $this->type = 'time';
        return $this;
    }

    public function staticDate(): Date
    {
        $this->type = 'static-date';
        return $this;
    }

    public function staticDatetime(): Date
    {
        $this->type = 'static-datetime';
        return $this;
    }

    public function staticTime(): Date
    {
        $this->type = 'static-time';
        return $this;
    }
}
