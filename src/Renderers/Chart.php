<?php

namespace SmallRuralDog\AmisAdmin\Renderers;

/**
 * @method $this chartTheme($v)
 * @method $this api($v)
 * @method $this initFetch($v)
 * @method $this initFetchOn($v)
 * @method $this config($v)
 * @method $this trackExpression($v)
 * @method $this width($v)
 * @method $this height($v)
 * @method $this interval($v)
 * @method $this name($v)
 * @method $this style($v)
 * @method $this dataFilter($v)
 * @method $this source($v)
 * @method $this disableDataMapping($v)
 * @method $this clickAction($v)
 * @method $this replaceChartOption($v)
 * @method $this unMountOnHidden($v)
 */
class Chart extends BaseSchema
{
    public string $type = 'chart';
}
