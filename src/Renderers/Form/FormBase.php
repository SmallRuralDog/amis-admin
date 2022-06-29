<?php

namespace SmallRuralDog\AmisAdmin\Renderers\Form;

use SmallRuralDog\AmisAdmin\Renderers\BaseSchema;
use Storage;

/**
 * @method $this size($v)
 * @method $this label($v)
 * @method $this labelClassName($v)
 * @method $this name($v)
 * @method $this remark($v)
 * @method $this clearable($v)
 * @method $this labelRemark($v)
 * @method $this hint($v)
 * @method $this submitOnChange($v)
 * @method $this readOnly($v)
 * @method $this readOnlyOn($v)
 * @method $this validateOnChange($v)
 * @method $this description($v)
 * @method $this desc($v)
 * @method $this descriptionClassName($v)
 * @method $this mode($v)
 * @method $this horizontal($v)
 * @method $this inline($v)
 * @method $this inputClassName($v)
 * @method $this placeholder($v)
 * @method $this required($v)
 * @method $this requiredOn($v)
 * @method $this validationErrors($v)
 * @method $this validations($v)
 * @method $this value($v)
 * @method $this clearValueOnHidden($v)
 * @method $this validateApi($v)
 *
 * @method $this columnRatio($v) 宽度占用比率。在某些容器里面有用比如 group
 */
class FormBase extends BaseSchema
{
    public string $type = "input-text";


    protected function deleteFile($file): bool
    {
        if (is_string($file)) {
            $storage = Storage::disk(config('amis-admin.upload.disk'));
            if ($storage->exists($file)) {
                return $storage->delete($file);
            }
        }
        return false;
    }

}
