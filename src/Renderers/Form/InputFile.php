<?php

namespace SmallRuralDog\AmisAdmin\Renderers\Form;

/**
 * @method $this btnLabel($v)
 * @method $this accept($v)
 * @method $this asBase64($v)
 * @method $this asBlob($v)
 * @method $this autoUpload($v)
 * @method $this chunkApi($v)
 * @method $this chunkSize($v)
 * @method $this concurrency($v)
 * @method $this delimiter($v)
 * @method $this downloadUrl($v)
 * @method $this templateUrl($v)
 * @method $this fileField($v)
 * @method $this finishChunkApi($v)
 * @method $this hideUploadButton($v)
 * @method $this maxLength($v)
 * @method $this maxSize($v)
 * @method $this receiver($v)
 * @method $this startChunkApi($v)
 * @method $this useChunk($v)
 * @method $this btnClassName($v)
 * @method $this btnUploadClassName($v)
 * @method $this multiple($v)
 * @method $this joinValues($v)
 * @method $this extractValue($v)
 * @method $this resetValue($v)
 * @method $this autoFill($v)
 * @method $this valueField($v)
 * @method $this nameField($v)
 * @method $this urlField($v)
 * @method $this stateTextMap($v)
 * @method $this drag($v)
 */
class InputFile extends FormBase
{
    public string $type = 'input-file';

    public function __construct()
    {
        $this->receiver(route('amis-admin.handle-upload-file'));
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
}
