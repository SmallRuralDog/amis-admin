<?php

namespace SmallRuralDog\AmisAdmin\Components\Enhance;

use JsonSerializable;
use SmallRuralDog\AmisAdmin\Renderers\Tpl;

class AutoRoute implements JsonSerializable
{

    use AutoRouteAction;


    protected function render()
    {
        return Tpl::make();
    }

    public function jsonSerialize()
    {
        return $this->render();
    }
}
