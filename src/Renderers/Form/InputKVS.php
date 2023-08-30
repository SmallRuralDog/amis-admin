<?php

namespace SmallRuralDog\AmisAdmin\Renderers\Form;
/**
 * @method self valueType($v)
 * @method self keyPlaceholder($v)
 * @method self valuePlaceholder($v)
 * @method self defaultValue($v)
 * @method self draggable($v)
 * @method self addButtonText($v)
 * @method self keyItem($v)
 * @method self valueItems($v)
 */
class InputKVS extends FormBase
{
    public string $type = 'input-kvs';

    public function getValue($value)
    {
        if (is_array($value)) {
            foreach ($value as $key => $v) {
                if (is_array($v)) {
                    foreach ($v as $k => $item) {
                        $component = collect($this->valueItems)->firstWhere('name', $k);
                        if (is_object($component) && method_exists($component::class, 'getValue')) {
                            data_set($value, $key . '.' . $k, $component->getValue($item));
                        }
                    }
                } else {
                    $component = collect($this->valueItems)->firstWhere('name', $key);
                    if (is_object($component) && method_exists($component::class, 'getValue')) {
                        data_set($value, $key, $component->getValue($v));
                    }
                }
            }
        }
        return $value;
    }

    public function setValue($value)
    {
        if (is_array($value)) {
            foreach ($value as $key => $v) {
                if (is_array($v)) {
                    foreach ($v as $k => $item) {
                        $component = collect($this->valueItems)->firstWhere('name', $k);
                        if (is_object($component) && method_exists($component::class, 'setValue')) {
                            data_set($value, $key . '.' . $k, $component->setValue($item));
                        }
                    }
                } else {
                    $component = collect($this->valueItems)->firstWhere('name', $key);
                    if (is_object($component) && method_exists($component::class, 'setValue')) {
                        data_set($value, $key, $component->setValue($v));
                    }
                }
            }
        }
        return $value;
    }

    public function onDelete($value)
    {
        if (is_array($value)) {
            foreach ($value as $key => $v) {
                if (is_array($v)) {
                    foreach ($v as $k => $item) {
                        $component = collect($this->valueItems)->firstWhere('name', $k);
                        if (is_object($component) && method_exists($component::class, 'onDelete')) {
                            data_set($value, $key . '.' . $k, $component->onDelete($item));
                        }
                    }
                } else {
                    $component = collect($this->valueItems)->firstWhere('name', $key);
                    if (is_object($component) && method_exists($component::class, 'onDelete')) {
                        data_set($value, $key, $component->onDelete($v));
                    }
                }
            }
        }
        return $value;
    }
}
