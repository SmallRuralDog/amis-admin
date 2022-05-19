<?php

namespace SmallRuralDog\AmisAdmin\Components\Form;

use Closure;
use SmallRuralDog\AmisAdmin\Renderers\BaseSchema;
use SmallRuralDog\AmisAdmin\Renderers\Form\AmisForm;
use SmallRuralDog\AmisAdmin\Renderers\Form\Hidden;

trait FormMain
{
    private AmisForm $form;
    private array $items = [];


    protected BaseSchema|array|null $customLayout = null;

    /**
     * 添加表单项
     * @param string $name
     * @param string $label
     * @return Item
     */
    public function item(string $name = '', string $label = ''): Item
    {
        return $this->addItem($name, $label);
    }

    protected function addItem($name = '', $label = ''): Item
    {
        $item = new Item($name, $label);
        $this->items[] = $item;
        return $item;
    }

    /**
     * 自定义布局
     * @param BaseSchema|array|Closure $customLayout
     * @return $this
     */
    public function customLayout(BaseSchema|array|Closure $customLayout): self
    {
        if ($customLayout instanceof Closure) {
            $customLayout = $customLayout();
        }
        $this->customLayout = $customLayout;
        return $this;
    }

    /**
     * 获取AmisForm对象
     * @return AmisForm
     */
    public function useForm(): AmisForm
    {

        return $this->renderForm();
    }


    /**
     * 获取表单提交地址
     * @return string
     */
    private function getAction()
    {
        if ($this->isEdit) {
            return $this->getUpdateUrl($this->editKey);
        }
        return $this->getStoreUrl();
    }


    public function renderForm(): AmisForm
    {

        //表单项配置
        if ($this->customLayout) {
            $items = $this->customLayout;
        } else {
            $items = [];
            foreach ($this->items as $item) {
                /**@var Item $item */
                $items[] = $item->render();
            }
        }


        //提交地址
        $this->form->api($this->getAction());

        //初始化编辑数据
        if ($this->isEdit && $this->editData) {
            $this->actions->disableReset();
            $this->form->data($this->getEditData());
        }
        //添加操作配置
        if (!$this->disableAction) {
            $this->form->actions($this->actions->render());
        }
        //弹窗表单设置
        if ($this->isDialog()) {
            $this->form->wrapWithPanel(false);
        } else {
            //提交后行为
            $this->form->redirect("back()");
        }

        $this->form->body($items);

        return $this->form;

    }

}
