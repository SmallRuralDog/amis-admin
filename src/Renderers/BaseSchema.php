<?php

namespace SmallRuralDog\AmisAdmin\Renderers;

use Closure;

/**
 * @method $this type($v)
 * @method $this className($v)
 * @method $this style($v)
 * @method $this ref($v)
 * @method $this disabled($v)
 * @method $this disabledOn($v)
 * @method $this hidden($v)
 * @method $this hiddenOn($v)
 * @method $this visible($v)
 * @method $this visibleOn($v)
 * @method $this id($v)
 */
class BaseSchema
{
    public string $type;

    public static function make(): static
    {
        return new static();
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
        return $this;
    }

    public function __call($name, $arguments)
    {
        abort_if(count($arguments) !== 1, 400, "{$name} method parameter error");
        $argument = $arguments[0];
        if ($argument instanceof Closure) {
            $argument = $argument();
        }
        $this->$name = $argument;
        return $this;
    }

}
