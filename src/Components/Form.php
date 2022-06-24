<?php

namespace SmallRuralDog\AmisAdmin\Components;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use JsonSerializable;
use SmallRuralDog\AmisAdmin\Components\Form\Actions;
use SmallRuralDog\AmisAdmin\Components\Form\FormActions;
use SmallRuralDog\AmisAdmin\Components\Form\FormHooks;
use SmallRuralDog\AmisAdmin\Components\Form\FormMain;
use SmallRuralDog\AmisAdmin\Components\Form\FormResource;
use SmallRuralDog\AmisAdmin\Components\Form\FormToolbar;
use SmallRuralDog\AmisAdmin\Components\Form\Toolbar;
use SmallRuralDog\AmisAdmin\Renderers\Form\AmisForm;
use SmallRuralDog\AmisAdmin\Renderers\Page;


class Form implements JsonSerializable
{
    use FormMain, FormResource, ModelBase, FormToolbar, FormActions, FormHooks;

    public const REMOVE_FLAG_NAME = '_remove_flag';

    private Page $page;
    private string $routeName;

    private Builder $builder;
    private Model $model;

    protected bool $isDialog = false;

    public function __construct()
    {
        $this->page = Page::make()->title("编辑");
        $this->form = AmisForm::make();

        $this->toolbar = new Toolbar($this);
        $this->actions = new Actions($this);

        $this->isDialog = (int)request('_dialog', 0) === 1;

    }

    public static function make($builder, string $routeName, $fun): Form
    {
        $form = new static();
        $form->builder = $builder;
        $form->routeName = $routeName;
        $form->model = $builder->getModel();
        $fun($form);
        return $form;
    }

    public function model(): Model|Builder
    {
        return $this->builder->getModel();
    }

    /**
     * 获取AmisPage实例
     * @return Page
     */
    public function usePage(): Page
    {
        return $this->page;
    }

    /**
     * @return bool
     */
    public function isDialog(): bool
    {
        return $this->isDialog;
    }

    public function jsonSerialize()
    {

        if ($this->isDialog()) {
            return $this->renderForm();
        }

        $this->page
            ->toolbar($this->toolbar->renderToolbar())
            ->body([
                $this->renderForm(),
            ]);

        return $this->page;
    }
}
