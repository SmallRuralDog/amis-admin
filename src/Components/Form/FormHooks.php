<?php

namespace SmallRuralDog\AmisAdmin\Components\Form;

use Arr;
use Closure;
use SmallRuralDog\AmisAdmin\Components\Form;

trait FormHooks
{
    protected array $hooks = [];

    protected function registerHook($name, Closure $callback): self
    {
        $this->hooks[$name][] = $callback;
        return $this;
    }

    protected function callHooks($name, $parameters = []): void
    {
        $hooks = Arr::get($this->hooks, $name, []);
        foreach ($hooks as $func) {
            if (!$func instanceof Closure) {
                continue;
            }
            $func($this, $parameters);
        }
    }


    public function editing(Closure $callback): Form
    {
        return $this->registerHook('editing', $callback);
    }

    public function editData(Closure $callback): Form
    {
        return $this->registerHook('editData', $callback);
    }

    public function submitted(Closure $callback): Form
    {
        return $this->registerHook('submitted', $callback);
    }

    public function saving(Closure $callback): Form
    {
        return $this->registerHook('saving', $callback);
    }

    public function saved(Closure $callback): Form
    {
        return $this->registerHook('saved', $callback);
    }

    public function deleting(Closure $callback): Form
    {
        return $this->registerHook('deleting', $callback);
    }

    public function deleted(Closure $callback): Form
    {
        return $this->registerHook('deleted', $callback);
    }

    public function transaction(Closure $callback): Form
    {
        return $this->registerHook('transaction', $callback);
    }

    public function validating(Closure $callback): Form
    {
        return $this->registerHook('validating', $callback);
    }

    public function useRules(Closure $callback): Form
    {
        return $this->registerHook('useRules', $callback);
    }

    protected function callEditing($id): void
    {
        $this->callHooks('editing', $id);
    }

    protected function callEdiData($data): void
    {
        $this->callHooks('editData', $data);
    }

    protected function callSubmitted(): void
    {
        $this->callHooks('submitted');
    }

    protected function callSaving(): void
    {
        $this->callHooks('saving');
    }

    protected function callSaved(): void
    {
        $this->callHooks('saved');
    }

    protected function callDeleting($id): void
    {
        $this->callHooks('deleting', $id);
    }

    protected function callDeleted(): void
    {
        $this->callHooks('deleted');
    }

    protected function callTransaction(): void
    {
        $this->callHooks('transaction');
    }

    protected function callUseRules($rules): void
    {
        $this->callHooks('useRules', $rules);
    }

    protected function callValidating($validator): void
    {
        $this->callHooks('validating', $validator);
    }
}
