<?php

namespace SmallRuralDog\AmisAdmin\Renderers\Form;

/**
 * @method $this titlePosition($v)
 * @method $this collapsable($v)
 * @method $this collapsed($v)
 * @method $this body($v)
 * @method $this title($v)
 * @method $this collapseTitle($v)
 * @method $this mountOnEnter($v)
 * @method $this unmountOnExit($v)
 * @method $this subFormMode($v)
 * @method $this subFormHorizontal($v)
 */
class FieldSet extends FormBase
{
    public string $type = 'fieldset';
}
