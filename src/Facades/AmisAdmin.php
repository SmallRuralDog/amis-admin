<?php

namespace SmallRuralDog\AmisAdmin\Facades;

use Illuminate\Support\Facades\Facade;

class AmisAdmin extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'amis-admin';
    }
}
