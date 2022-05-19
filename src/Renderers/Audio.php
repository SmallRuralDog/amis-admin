<?php

namespace SmallRuralDog\AmisAdmin\Renderers;


/**
 * 音频渲染器
 * @method $this inline($v)
 * @method $this src($v)
 * @method $this loop($v)
 * @method $this autoPlay($v)
 * @method $this rates($v)
 * @method $this controls($v)
 */
class Audio extends BaseSchema
{
    public string $type = 'audio';

}
