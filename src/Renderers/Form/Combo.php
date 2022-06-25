<?php

namespace SmallRuralDog\AmisAdmin\Renderers\Form;

/**
 * @method self scaffold($v)
 * @method self noBorder($v)
 * @method self deleteConfirmText($v)
 * @method self deleteApi($v)
 * @method self typeSwitchable($v)
 * @method self conditions($v)
 * @method self formClassName($v)
 * @method self addButtonClassName($v)
 * @method self addButtonText($v)
 * @method self addable($v)
 * @method self items($v)
 * @method self draggable($v)
 * @method self draggableTip($v)
 * @method self flat($v)
 * @method self delimiter($v)
 * @method self joinValues($v)
 * @method self maxLength($v)
 * @method self minLength($v)
 * @method self multiLine($v)
 * @method self multiple($v)
 * @method self removable($v)
 * @method self subFormMode($v)
 * @method self placeholder($v)
 * @method self canAccessSuperData($v)
 * @method self tabsMode($v)
 * @method self tabsStyle($v)
 * @method self tabsLabelTpl($v)
 * @method self lazyLoad($v)
 * @method self strictMode($v)
 * @method self syncFields($v)
 * @method self nullable($v)
 * @method self messages($v)
 */
class Combo extends FormBase
{
    public string $type = 'combo';

    public function getValue($value)
    {
        if (is_array($value)) {
            foreach ($value as $key => $v) {
                $component = collect($this->items)->firstWhere('name', $key);
                if (is_object($component) && method_exists($component::class, 'getValue')) {
                    data_set($value, $key, $component->getValue($v));
                }
            }
        }
        return $value;
    }

    public function setValue($value)
    {
        if (is_array($value)) {
            foreach ($value as $key => $v) {
                $component = collect($this->items)->firstWhere('name', $key);
                if (is_object($component) && method_exists($component::class, 'setValue')) {
                    data_set($value, $key, $component->setValue($v));
                }
            }
        }
        return $value;
    }

    public function onDelete($value): void
    {
        if (is_array($value)) {
            foreach ($value as $key => $v) {
                $component = collect($this->items)->firstWhere('name', $key);
                if (is_object($component) && method_exists($component::class, 'onDelete')) {
                    data_set($value, $key, $component->onDelete($v));
                }
            }
        }
    }
}
