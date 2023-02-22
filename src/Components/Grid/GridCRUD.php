<?php

namespace SmallRuralDog\AmisAdmin\Components\Grid;

use SmallRuralDog\AmisAdmin\Renderers\BaseSchema;
use SmallRuralDog\AmisAdmin\Renderers\CRUD;

trait GridCRUD
{
    use GridFilter, GridActions;

    private CRUD $crud;
    private string $crudName = "crud";
    protected array $columns = [];
    protected array $headers = [];
    protected array $footers = [];

    private bool $loadDataOnce = false;


    /**
     * 获得AmisCRUD组件
     * @return CRUD
     */
    public function useCRUD()
    {
        return $this->crud;
    }

    /**
     * @return string
     */
    public function getCrudName(): string
    {
        return $this->crudName;
    }

    /**
     * @param string $crudName
     */
    public function setCrudName(string $crudName): void
    {
        $this->crudName = $crudName;
    }


    /**
     *  添加列表项
     * @param string $name
     * @param string $label
     * @return Column
     */
    public function column(string $name, string $label = ''): Column
    {
        return $this->addColumn($name, $label);
    }

    protected function addColumn($name = '', $label = ''): Column
    {
        $column = new Column($name, $label);
        $this->columns[] = $column;
        return $column;
    }

    /**
     * @return array
     */
    public function getColumns(): array
    {
        return $this->columns;
    }


    /**
     * 是否一次性加载
     * @return bool
     */
    public function isLoadDataOnce(): bool
    {
        return $this->loadDataOnce;
    }

    /**
     * 一次性加载
     * @param bool $loadDataOnce
     * @return self
     */
    public function loadDataOnce(bool $loadDataOnce = true): self
    {
        $this->loadDataOnce = $loadDataOnce;
        return $this;
    }

    /**
     * 添加头部组建
     * @param BaseSchema $header
     * @return $this
     */
    public function header(BaseSchema $header){
        $this->headers[] = $header;
        return $this;
    }

    protected function renderHeader()
    {
        $header = [];
        foreach ($this->headers as $item) {
            $header[] = $item;
        }
        return $header;
    }

    /**
     * 添加底部组建
     * @param BaseSchema $footer
     * @return $this
     */
    public function footer(BaseSchema $footer)
    {
        $this->footers[] = $footer;
        return $this;
    }

    protected function renderFooter()
    {
        $footer = [];
        foreach ($this->footers as $item) {
            $footer[] = $item;
        }
        return $footer;
    }


    protected function renderCRUD(): CRUD
    {

        //
        $this->crud->name($this->crudName);

        //数据来源API
        $api = $this->getIndexUrl(['_action' => 'getData']);
        $this->crud->api($api);
        //快速编辑后用来批量保存的 API
        $this->crud->quickSaveApi($this->getUpdateUrl("quickSave"));
        $this->crud->quickSaveItemApi($this->getUpdateUrl("quickSaveItem"));

        //

        $columns = [];
        //TODO 分组 分块
        foreach ($this->columns as $column) {
            /**@var Column $column */
            $columns[] = $column->render();
        }


        //添加过滤器配置
        $renderFilter = $this->renderFilter();
        if (count($renderFilter->getFilterField()) > 0) {
            $this->crud->filter($this->renderFilter());
            $this->toolbar->prependHeaderToolbar("filter-toggler");
        }
        //添加行操作配置
        if (!$this->disableAction) {

            if ($this->actions->isHoverAction()) {
                $this->crud->itemActions($this->renderAction());
            } else {
                $columns[] = [
                    'type' => 'operation',
                    'label' => '操作',
                    'width' => $this->actions->getWidth(),
                    'buttons' => $this->renderAction(),
                ];
            }
        }
        //添加工具栏配置
        $footerToolbar = $this->toolbar->renderFooterToolbar();
        if (count($footerToolbar) > 0) {
            $this->crud->footerToolbar($footerToolbar);
        }
        $headerToolbar = $this->toolbar->renderHeaderToolbar();
        if (count($headerToolbar) > 0) {
            $this->crud->headerToolbar($headerToolbar);
        }
        $bulkActions = $this->toolbar->renderBulkActions();
        if (count($bulkActions) > 0) {
            $this->crud->bulkActions($bulkActions);
        }

        //一次性加载
        if ($this->loadDataOnce) {
            $this->crud->loadDataOnce(true);
        }


        //添加列配置
        $this->crud->columns($columns);

        $this->crud->primaryField($this->getPrimaryKey());

        return $this->crud;

    }

}
