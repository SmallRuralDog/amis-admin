<?php

namespace SmallRuralDog\AmisAdmin\Renderers\Form;

/**
 * @method $this src($v)
 * @method $this imageClassName($v)
 * @method $this accept($v)
 * @method $this allowInput($v)
 * @method $this autoUpload($v)
 * @method $this btnClassName($v)
 * @method $this btnUploadClassName($v)
 * @method $this compress($v)
 * @method $this crop($v)
 * @method $this cropFormat($v)
 * @method $this cropQuality($v)
 * @method $this reCropable($v)
 * @method $this hideUploadButton($v)
 * @method $this limit($v)
 * @method $this maxLength($v)
 * @method $this maxSize($v)
 * @method $this receiver($v)
 * @method $this showCompressOptions($v)
 * @method $this multiple($v)
 * @method $this joinValues($v)
 * @method $this delimiter($v)
 * @method $this extractValue($v)
 * @method $this resetValue($v)
 * @method $this thumbMode($v)
 * @method $this thumbRatio($v)
 * @method $this autoFill($v)
 * @method $this initAutoFill($v)
 * @method $this frameImage($v)
 * @method $this fixedSize($v)
 * @method $this fixedSizeClassName($v)
 */
class InputImage extends FormBase
{
    public string $type = 'input-image';

    private bool $reserved = false;

    public function __construct()
    {
        $this->receiver(route('amis-admin.handle-upload-image'));
    }

    /**
     * 使用唯一名称
     * @return $this
     */
    public function uniqueName(): self
    {
        $this->receiver(route('amis-admin.handle-upload-image', ['unique_name' => true]));
        return $this;
    }

    /**
     * 数据删除时保留文件
     * @param bool $reserved
     * @return InputImage
     */
    public function reserved(bool $reserved = true): InputImage
    {
        $this->reserved = $reserved;
        return $this;
    }

    public function getValue($value)
    {
        if (is_array($value)) {
            return array_map(function ($v) {
                return admin_file_url($v);
            }, $value);
        }
        return admin_file_url($value);
    }

    public function setValue($value)
    {
        if (is_array($value)) {
            return array_map(function ($v) {
                return admin_file_restore_path($v);
            }, $value);
        }
        return admin_file_restore_path($value);
    }

    public function onDelete($value): void
    {
        if ($this->reserved) return;
        if ($value && is_array($value)) {
            array_map(function ($v) {
                $this->deleteFile($v);
            }, $value);
        }
        $this->deleteFile($value);
    }
}
