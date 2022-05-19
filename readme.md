# AmisAdmin

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
