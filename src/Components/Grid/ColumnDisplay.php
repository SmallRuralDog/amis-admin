<?php

namespace SmallRuralDog\AmisAdmin\Components\Grid;

use Closure;
use SmallRuralDog\AmisAdmin\Renderers\Image;

trait ColumnDisplay
{

    public function image($w = 80, $h = 80, Closure $closure = null): self
    {
        $image = Image::make()->width($w)->height($h);
        if ($closure) {
            $closure($image);
        }
        $this->useTableColumn($image);
        return $this;
    }

}
