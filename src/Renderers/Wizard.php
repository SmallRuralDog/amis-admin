<?php

namespace SmallRuralDog\AmisAdmin\Renderers;

/**
 * @method $this actionClassName($v)
 * @method $this actionFinishLabel($v)
 * @method $this actionNextLabel($v)
 * @method $this actionNextSaveLabel($v)
 * @method $this actionPrevLabel($v)
 * @method $this api($v)
 * @method $this bulkSubmit($v)
 * @method $this initApi($v)
 * @method $this mode($v)
 * @method $this name($v)
 * @method $this readOnly($v)
 * @method $this redirect($v)
 * @method $this reload($v)
 * @method $this target($v)
 * @method $this affixFooter($v)
 * @method $this steps($v)
 * @method $this startStep($v)
 */
class Wizard extends BaseSchema
{
    public string $type = 'wizard';
}
