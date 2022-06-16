# Amis Admin
`Amis Admin` 是一个 `Laravel` + `Amis` 开发的后台扩展，只需简单的代码即可搭建出一个功能强大的后台管理系统。

[Amis Admin文档](https://www.yuque.com/smallruraldog/kghkg8) ｜
[Amis文档](https://aisuda.bce.baidu.com/amis/zh-CN/docs/index)。

## 什么是 amis
[Amis](https://github.com/baidu/amis) 是一个低代码前端框架，它使用 JSON 配置来生成页面，可以减少页面开发工作量，极大提升效率。

熟悉`Laravel Admin`或者`Dcat Admin`的很快就能上手使用 `Amis Admin`

建议先体验一下`Amis`的功能。[Amis在线体验](https://aisuda.bce.baidu.com/amis/zh-CN/components/page)

# 环境

- PHP >= 8.0
- Laravel >= 8

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

## 感谢

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
