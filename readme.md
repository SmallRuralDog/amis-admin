# AmisAdmin

# 环境
- PHP >= 8.0
- Laravel >= 8


## 安装
``` bash
composer require smallruraldog/amis-admin
```

## 发布资源
``` bash
php artisan vendor:publish --provider="SmallRuralDog\AmisAdmin\AmisAdminServiceProvider"
```
## 完成安装
``` bash
php artisan admin:install
```
启动服务后，在浏览器打开 `/admin` ,使用用户名 admin 和密码 admin登录.
