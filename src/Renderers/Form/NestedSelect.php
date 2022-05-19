<?php

namespace SmallRuralDog\AmisAdmin\Renderers\Form;

/**
 * @method $this borderMode($v)
 * @method $this menuClassName($v)
 * @method $this cascade($v)
 * @method $this withChildren($v)
 * @method $this onlyChildren($v)
 * @method $this onlyLeaf($v)
 * @method $this hideNodePathLabel($v)
 */
class NestedSelect extends FormOptions
{
    public string $type = 'nested-select';
}
