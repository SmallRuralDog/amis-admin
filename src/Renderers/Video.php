<?php

namespace SmallRuralDog\AmisAdmin\Renderers;

/**
 * @method $this autoPlay($v)
 * @method $this columnsCount($v)
 * @method $this frames($v)
 * @method $this framesClassName($v)
 * @method $this isLive($v)
 * @method $this jumpFrame($v)
 * @method $this muted($v)
 * @method $this playerClassName($v)
 * @method $this poster($v)
 * @method $this splitPoster($v)
 * @method $this src($v)
 * @method $this videoType($v)
 * @method $this aspectRatio($v)
 * @method $this rates($v)
 * @method $this jumpBufferDuration($v)
 * @method $this stopOnNextFrame($v)
 */
class Video extends BaseSchema
{
    public string $type = 'video';
}
