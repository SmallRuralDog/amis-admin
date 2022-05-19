<?php

namespace SmallRuralDog\AmisAdmin\Renderers\Form;

use SmallRuralDog\AmisAdmin\Renderers\BaseSchema;

/**
 * @method $this title($v)
 * @method $this actions($v)
 * @method $this body($v)
 * @method $this tabs($v)
 * @method $this fieldSet($v)
 * @method $this data($v)
 * @method $this debug($v)
 * @method $this initApi($v)
 * @method $this initAsyncApi($v)
 * @method $this initFinishedField($v)
 * @method $this initCheckInterval($v)
 * @method $this initFetch($v)
 * @method $this initFetchOn($v)
 * @method $this interval($v)
 * @method $this silentPolling($v)
 * @method $this stopAutoRefreshWhen($v)
 * @method $this persistData($v)
 * @method $this clearPersistDataAfterSubmit($v)
 * @method $this api($v)
 * @method $this feedback($v)
 * @method $this asyncApi($v)
 * @method $this checkInterval($v)
 * @method $this finishedField($v)
 * @method $this resetAfterSubmit($v)
 * @method $this clearAfterSubmit($v)
 * @method $this mode($v)
 * @method $this columnCount($v)
 * @method $this horizontal($v)
 * @method $this autoFocus($v)
 * @method $this messages($v)
 * @method $this name($v)
 * @method $this panelClassName($v)
 * @method $this primaryField($v)
 * @method $this redirect($v)
 * @method $this reload($v)
 * @method $this submitOnChange($v)
 * @method $this submitOnInit($v)
 * @method $this submitText($v)
 * @method $this target($v)
 * @method $this wrapWithPanel($v)
 * @method $this affixFooter($v)
 * @method $this promptPageLeave($v)
 * @method $this promptPageLeaveMessage($v)
 * @method $this rules($v)
 * @method $this preventEnterSubmit($v)
 */
class AmisForm extends BaseSchema
{
    public string $type = 'form';
}
