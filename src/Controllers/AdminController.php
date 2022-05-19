<?php

namespace SmallRuralDog\AmisAdmin\Controllers;

use AmisAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{

    /**
     * @var bool 是否创建界面
     */
    protected bool $isCreate = false;
    /**
     * @var bool 是否编辑界面
     */
    protected bool $isEdit = false;
    /**
     * @var bool 是否新增提交
     */
    protected bool $isStore = false;
    /**
     * @var bool 是否修改提交
     */
    protected bool $isUpdate = false;
    /**
     * @var mixed|null 当前更新的id
     */
    protected mixed $resourceKey = null;

    public function index(): JsonResponse
    {
        return AmisAdmin::response($this->grid());
    }

    public function create()
    {

        $this->isCreate = true;

        return AmisAdmin::response($this->form());
    }

    public function edit($id)
    {

        $this->isEdit = true;
        $this->resourceKey = $id;
        return AmisAdmin::response($this->form()->edit($id));
    }

    public function update($id)
    {
        $this->resourceKey = $id;
        $this->isUpdate = true;

        if ($id === "quickSave") {
            return $this->form()->quickUpdate();
        }
        if ($id === "quickSaveItem") {
            return $this->form()->quickItemUpdate();
        }
        return $this->form()->update($id);
    }

    public function store()
    {
        $this->isStore = true;
        return $this->form()->store();
    }

    public function destroy($id)
    {
        $this->resourceKey = $id;
        return $this->form()->destroy($id);
    }
}
