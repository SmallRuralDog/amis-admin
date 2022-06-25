<?php

namespace SmallRuralDog\AmisAdmin\Renderers\Form;

/**
 * @method $this vendor($v)
 * @method $this receiver($v)
 * @method $this videoReceiver($v)
 * @method $this fileField($v)
 * @method $this borderMode($v)
 * @method $this options($v)
 */
class InputRichText extends FormBase
{
    public string $type = 'input-rich-text';

    public function __construct()
    {
        $this->receiver(route('amis-admin.handle-upload-image', ['unique_name' => true]));


    }

    public function defaultAttr()
    {

        $options = $this->options ?? [];

        $this->options(array_merge([
            'relative_urls' => false,
            'convert_urls' => false,
        ], $options));
    }
}
