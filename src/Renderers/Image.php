<?php

namespace SmallRuralDog\AmisAdmin\Renderers;

/**
 * @method $this defaultImage($v)
 * @method $this title($v)
 * @method $this name($v)
 * @method $this imageCaption($v)
 * @method $this src($v)
 * @method $this originalSrc($v)
 * @method $this enlargeAble($v)
 * @method $this alt($v)
 * @method $this height($v)
 * @method $this width($v)
 * @method $this imageClassName($v)
 * @method $this className($v)
 * @method $this thumbClassName($v)
 * @method $this caption($v)
 * @method $this imageMode($v)
 * @method $this thumbMode($v)
 * @method $this thumbRatio($v)
 * @method $this href($v)
 * @method $this blank($v)
 * @method $this htmlTarget($v)
 */
class Image extends BaseSchema
{
    public string $type = 'image';

    public function getValue($value)
    {
        return admin_file_url($value);
    }
}
