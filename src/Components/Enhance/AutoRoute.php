<?php

namespace SmallRuralDog\AmisAdmin\Components\Enhance;

use JsonSerializable;
use SmallRuralDog\AmisAdmin\Renderers\Tpl;

class AutoRoute implements JsonSerializable
{

    use AutoRouteAction;

    public static function make()
    {
        return new static();
    }


    public function render()
    {
        return Tpl::make();
    }

    public function jsonSerialize()
    {
        return $this->render();
    }
}
