<?php

namespace SmallRuralDog\AmisAdmin\Renderers\Form;

/**
 * @method $this clearable($v)
 * @method $this format($v)
 * @method $this inputFormat($v)
 * @method $this utc($v)
 * @method $this emebed($v)
 * @method $this borderMode($v)
 * @method $this minDate($v)
 * @method $this maxDate($v)
 */
class InputDate extends FormBase
{

    public string $type = 'input-date';

    public function __construct()
    {
        $this->format("YYYY-MM-DD HH:mm:ss");
    }

    public function datetime(): InputDate
    {
        $this->type = 'input-datetime';
        return $this;
    }

}
