<?php

namespace SmallRuralDog\AmisAdmin\Traits;

use Carbon\Carbon;
use DateTimeInterface;

trait HasDateTimeFormatter
{
    protected function serializeDate(DateTimeInterface $date)
    {
        return Carbon::parse($date)
            ->timezone(config('amis-admin.timezone'))
            ->format($this->getDateFormat());
    }
}
