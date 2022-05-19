<?php

namespace SmallRuralDog\AmisAdmin\Renderers;


/**
 * @method $this title($v) 页面标题
 * @method $this subTitle($v) 页面副标题
 * @method $this remark($v) 页面描述, 标题旁边会出现个小图标，放上去会显示这个属性配置的内容。
 * @method $this body($v) 内容区域
 * @method $this bodyClassName($v) 内容区 css 类名
 * @method $this aside($v) 边栏区域
 * @method $this asideClassName($v) 边栏区 css 类名
 * @method $this className($v) 配置容器 className
 * @method $this data($v)
 * @method $this headerClassName($v) 配置 header 容器 className
 * @method $this initApi($v) 页面初始化的时候，可以设置一个 API 让其取拉取，发送数据会携带当前 data 数据（包含地址栏参数），获取得数据会合并到 data 中，供组件内使用。
 * @method $this initFetch($v) 是否默认就拉取？
 * @method $this initFetchOn($v) 是否默认就拉取表达式？
 * @method $this messages($v)
 * @method $this name($v)
 * @method $this toolbar($v) 页面顶部区域，当存在 title 时在右上角显示。
 * @method $this toolbarClassName($v) 配置 toolbar 容器 className
 * @method $this definitions($v)
 * @method $this interval($v) 配置轮询间隔，配置后 initApi 将轮询加载。
 * @method $this silentPolling($v) 是否要静默加载，也就是说不显示进度
 * @method $this stopAutoRefreshWhen($v) 配置停止轮询的条件。
 * @method $this showErrorMsg($v) 是否显示错误信息，默认是显示的
 * @method $this cssVars($v)
 */
class Page extends BaseSchema
{
    /**
     * 指定为 page 渲染器。
     */
    public string $type = "page";

}
