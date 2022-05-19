<?php

namespace SmallRuralDog\AmisAdmin\Renderers;

/**
 * @method $this name($v)
 * @method $this qrcodeClassName($v)
 * @method $this codeSize($v)
 * @method $this backgroundColor($v)
 * @method $this foregroundColor($v)
 * @method $this level($v)
 * @method $this placeholder($v)
 */
class QRCode extends BaseSchema
{
    public string $type = 'qrcode';
}
