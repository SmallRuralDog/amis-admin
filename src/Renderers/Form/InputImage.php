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

    public function __construct()
    {
        $this->receiver(route('amis-admin.handle-upload-image'));
    }
}
