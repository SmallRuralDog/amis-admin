<?php

namespace SmallRuralDog\AmisAdmin\Renderers;

/**
 * @method $this btnClassName($v)
 * @method $this btnText($v)
 * @method $this checkApi($v)
 * @method $this interval($v)
 * @method $this items($v)
 * @method $this name($v)
 * @method $this operationLabel($v)
 * @method $this reSubmitApi($v)
 * @method $this remarkLabel($v)
 * @method $this retryBtnClassName($v)
 * @method $this retryBtnText($v)
 * @method $this statusLabel($v)
 * @method $this statusLabelMap($v)
 * @method $this statusTextMap($v)
 * @method $this submitApi($v)
 * @method $this tableClassName($v)
 * @method $this taskNameLabel($v)
 * @method $this initialStatusCode($v)
 * @method $this readyStatusCode($v)
 * @method $this loadingStatusCode($v)
 * @method $this canRetryStatusCode($v)
 * @method $this finishStatusCode($v)
 * @method $this errorStatusCode($v)
 */
class Tasks extends BaseSchema
{
    public string $type = 'tasks';
}
