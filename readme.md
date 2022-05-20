# Amis Admin
`Amis Admin` 是一个 `Laravel` + `Amis` 开发的后台扩展，只需简单的代码即可搭建出一个功能强大的后台管理系统。

[Amis Admin文档](https://www.yuque.com/smallruraldog/kghkg8) ｜
[Amis文档](https://aisuda.bce.baidu.com/amis/zh-CN/docs/index)。

## 什么是 amis
[Amis](https://aisuda.bce.baidu.com/amis/zh-CN/docs/index) 是一个低代码前端框架，它使用 JSON 配置来生成页面，可以减少页面开发工作量，极大提升效率。
## 与 `Laravel Admin` `Dcat Admin`的异同
我一直在用这两个，很强大，大大提高了项目开发的效率，但是在一些复杂的自定义功能时，官方所提供的相关组件不是很好实现

当发现`amis`的时候，我就觉得这必须得整一套出来，所以说 `Amis Admin`是站在了这些前辈们的肩上

由于`Amis Admin` 是前后端分离的，在一些使用方法上需要按照 `Amis` 的规则来，但是强大的功能，与友好的代码，使用过后就会发现

熟悉`Laravel Admin`或者`Dcat Admin`的很快就能上手使用 `Amis Admin`

建议先体验一下`Amis`的功能。如果觉得符合你的胃口，那么`Amis Admin`是你不二的选择

[Amis在线体验](https://aisuda.bce.baidu.com/amis/zh-CN/components/page)

# 环境

- PHP >= 8.0
- Laravel >= 8

## 使用前

基于amis的管理后台，需要熟悉amis的使用方法。建议先阅读[amis文档](https://aisuda.bce.baidu.com/amis/zh-CN/docs/index)。

## 安装

``` bash
composer require smallruraldog/amis-admin
```

## 发布

``` bash
php artisan vendor:publish --provider="SmallRuralDog\AmisAdmin\AmisAdminServiceProvider"
```

## 安装

``` bash
php artisan amis-admin:install
```

启动服务后，在浏览器打开 `/admin` ,使用用户名 admin 和密码 admin登录.

## 更新资源

更新版本后，需要重新更新前端资源

``` bash
php artisan vendor:publish --tag=amis-admin.assets --force
```

## 站在巨人的肩上

- Laravel
- Amis
- Vite
- Vue3
- vue-router
- pinia
- element-plus
- axios
- Laravel Admin
- Dcat Admin
