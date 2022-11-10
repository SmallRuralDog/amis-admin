<?php

namespace SmallRuralDog\AmisAdmin\Components\Form;

use Closure;
use SmallRuralDog\AmisAdmin\Components\Form;
use SmallRuralDog\AmisAdmin\Renderers\Form\FormBase;
use Str;

/**
 * @method $this size($v) 表单项大小 'xs' | 'sm' | 'md' | 'lg' | 'full'
 * @method $this label($v) 描述标题
 * @method $this labelClassName($v) 配置 label className
 * @method $this name($v) 字段名，表单提交时的 key，支持多层级，用.连接，如： a.b.c
 * @method $this remark($v) 显示一个小图标, 鼠标放上去的时候显示提示内容
 * @method $this clearable($v)
 * @method $this labelRemark($v) 显示一个小图标, 鼠标放上去的时候显示提示内容, 这个小图标跟 label 在一起
 * @method $this hint($v) 输入提示，聚焦的时候显示
 * @method $this submitOnChange($v) 当修改完的时候是否提交表单。
 * @method $this readOnly($v) 是否只读
 * @method $this readOnlyOn($v) 只读条件
 * @method $this validateOnChange($v) 不设置时，当表单提交过后表单项每次修改都会触发重新验证，如果设置了，则由此配置项来决定要不要每次修改都触发验证。
 * @method $this description($v) 描述内容，支持 Html 片段。
 * @method $this desc($v) 用 description 代替
 * @method $this descriptionClassName($v) 配置描述上的 className
 * @method $this mode($v) 配置当前表单项展示模式 'normal' | 'inline' | 'horizontal'
 * @method $this horizontal($v) 当配置为水平布局的时候，用来配置具体的左右分配。
 * @method $this inline($v) 表单 control 是否为 inline 模式。
 * @method $this inputClassName($v) 配置 input className
 * @method $this placeholder($v) 占位符
 * @method $this validationErrors($v) 验证失败的提示信息
 * @method $this validations($v)
 * @method $this value($v) 默认值
 * @method $this clearValueOnHidden($v) 表单项隐藏时，是否在当前 Form 中删除掉该表单项值。注意同名的未隐藏的表单项值也会删掉
 * @method $this validateApi($v) 远端校验表单项接口
 *
 * @method $this columnRatio($v) 宽度占用比率。在某些容器里面有用比如 group
 */
class Item
{
    use ItemValidator;

    protected string $label;
    protected string $name;

    protected Form $form;

    protected FormBase $formItem;

    public function __construct($name, $label)
    {
        if (empty($label)) {
            $label = Str::studly($name);
        }
        $this->name = $name;
        $this->label = $label;
        $this->formItem = FormBase::make()->label($label)->name($name);
    }

    public function __call($name, $arguments)
    {
        $this->formItem->$name(...$arguments);
        return $this;
    }


    /**
     * 设置表单项
     * @param $typeComponent
     * @return FormBase
     */
    public function useFormItem($typeComponent = null): FormBase
    {
        if ($typeComponent) {
            if ($typeComponent instanceof Closure) {
                $typeComponent = $typeComponent();
            }
            //组合已有的属性
            foreach ($this->formItem as $key => $value) {
                if (!property_exists($typeComponent, $key)) {
                    $typeComponent->$key = $value;
                }
            }
            //替换formItem
            $this->formItem = $typeComponent;
        }
        return $this->formItem;
    }

    /**
     * 获取name
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed|string
     */
    public function getLabel(): mixed
    {
        return $this->label;
    }

    /**
     * 渲染
     * @return FormBase
     */
    public function render(): FormBase
    {
        return $this->formItem;
    }
}
