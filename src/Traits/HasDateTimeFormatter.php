<?php

namespace SmallRuralDog\AmisAdmin\Traits;

use DateTimeInterface;

trait HasDateTimeFormatter
{
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format($this->getDateFormat());
    }
}
