<?php

namespace SmallRuralDog\AmisAdmin\Renderers\Form;

/**
 * @method self body($v)
 * @method self gap($v)
 * @method self direction($v)
 * @method self subFormMode($v)
 * @method self subFormHorizontal($v)
 */
class Group extends FormBase
{
    public string $type = 'group';

    public function directionVertical()
    {
        $this->direction('vertical');
        return $this;
    }
}
