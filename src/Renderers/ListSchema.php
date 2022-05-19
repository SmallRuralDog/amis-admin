<?php

namespace SmallRuralDog\AmisAdmin\Renderers;

/**
 * @method $this title($v)
 * @method $this footer($v)
 * @method $this footerClassName($v)
 * @method $this header($v)
 * @method $this headerClassName($v)
 * @method $this listItem($v)
 * @method $this source($v)
 * @method $this showFooter($v)
 * @method $this showHeader($v)
 * @method $this placeholder($v)
 * @method $this hideCheckToggler($v)
 * @method $this affixHeader($v)
 * @method $this itemCheckableOn($v)
 * @method $this itemDraggableOn($v)
 * @method $this checkOnItemClick($v)
 * @method $this valueField($v)
 * @method $this size($v)
 * @method $this itemAction($v)
 */
class ListSchema extends BaseSchema
{
    public string $type = 'list';
}
