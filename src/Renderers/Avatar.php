<?php

namespace SmallRuralDog\AmisAdmin\Renderers;

/**
 * @method $this className($v)
 * @method $this style($v)
 * @method $this badge($v)
 * @method $this src($v)
 * @method $this icon($v)
 * @method $this fit($v)
 * @method $this shape($v)
 * @method $this size($v)
 * @method $this text($v)
 * @method $this gap($v)
 * @method $this alt($v)
 * @method $this draggable($v)
 * @method $this crossOrigin($v)
 * @method $this onError($v)
 */
class Avatar extends BaseSchema
{
    public string $type = 'avatar';

    public function defaultAttr()
    {
        if (!$this->src) {
            $name = $this->name;
            $this->src('${' . $name . '}');
        }

    }

    public function getValue($value)
    {
        return admin_file_url($value);
    }
}
