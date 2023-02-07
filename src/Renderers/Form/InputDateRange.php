<?php

namespace SmallRuralDog\AmisAdmin\Renderers\Form;

/**
 * @method $this delimiter($v)
 * @method $this format($v)
 * @method $this inputFormat($v)
 * @method $this joinValues($v)
 * @method $this maxDate($v)
 * @method $this minDate($v)
 * @method $this maxDuration($v)
 * @method $this minDuration($v)
 * @method $this value($v)
 * @method $this borderMode($v)
 * @method $this embed($v)
 * @method $this ranges($v)
 * @method $this startPlaceholder($v)
 * @method $this endPlaceholder($v)
 */
class InputDateRange extends FormBase
{
    public string $type = 'input-date-range';

    public function __construct()
    {
        $this->format("YYYY-MM-DD HH:mm:ss");
        $this->ranges(['today', 'yesterday', 'prevweek', 'thisweek', 'thismonth', 'prevmonth', '7daysago']);
    }

    public function datetime(): InputDateRange
    {
        $this->type = 'input-datetime-range';
        return $this;
    }
}
