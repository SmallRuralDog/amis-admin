<?php

namespace SmallRuralDog\AmisAdmin\Components\Form;


use Arr;

trait ItemValidator
{

    protected array $rules = [];

    protected array $createRules = [];
    protected array $updateRules = [];

    protected array $rulesMessages = [];

    /**
     * 必填
     * @return $this
     */
    public function required(): self
    {
        $this->formItem->required(true);
        $this->rules(['required'], ['required' => '请输入' . $this->getLabel()]);
        return $this;
    }

    /**
     * 验证规则
     * @param array $rules
     * @param array $message
     * @return $this
     */
    public function rules(array $rules, array $message = []): self
    {
        $this->rules = Arr::collapse([$rules, $this->rules]);
        $this->rulesMessages = Arr::collapse([$message, $this->rulesMessages]);
        return $this;
    }


    /**
     * 新增时的验证规则
     * @param array $rules
     * @param array $message
     * @return $this
     */
    public function createRules(array $rules, array $message = []): self
    {
        $this->createRules = Arr::collapse([$rules, $this->createRules]);
        $this->rulesMessages = Arr::collapse([$message, $this->rulesMessages]);
        return $this;
    }

    /**
     * 更新时的验证规则
     * @param array $rules
     * @param array $message
     * @return $this
     */
    public function updateRules(array $rules, array $message = []): self
    {
        $this->updateRules = Arr::collapse([$rules, $this->updateRules]);
        $this->rulesMessages = Arr::collapse([$message, $this->rulesMessages]);
        return $this;
    }

    /**
     * @return array
     */
    public function getRules(): array
    {

        $rules = $this->rules;

        if (request()->isMethod('POST')) {
            $rules = Arr::collapse([$rules, $this->createRules]);
        } elseif (request()->isMethod('PUT')) {
            $rules = Arr::collapse([$rules, $this->updateRules]);
        }
        return $rules;
    }

    /**
     * @return array
     */
    public function getRulesMessages(): array
    {
        return $this->rulesMessages;
    }
}
