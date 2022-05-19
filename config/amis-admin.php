<?php

use SmallRuralDog\AmisAdmin\Models\AdminUser;
use SmallRuralDog\AmisAdmin\Models\Menu;
use SmallRuralDog\AmisAdmin\Models\Permission;
use SmallRuralDog\AmisAdmin\Models\Role;

return [
    'name' => 'Amis-Admin',
    'title' => 'Amis-Admin',
    //登录界面
    'loginLogo' =>'',
    'loginDesc' => '站在巨人的肩上 - 超强的自定义后台管理系统',
    //默认头像
    'default_avatar' => 'https://gw.alipayobjects.com/zos/antfincdn/XAosXuNZyF/BiazfanxmamNRoxxVxka.png',
    //版权
    'copyright' => 'Copyright © 2022 SmallRuralDog',
    //底部菜单
    'footerLinks' => [
        [
            'href' => 'https://github.com/SmallRuralDog/amis-admin',
            'title' => '官网'
        ],
        [
            'href' => 'https://www.yuque.com/smallruraldog/laravel-vue-admin/overview',
            'title' => '文档'
        ]
    ],
    'bootstrap' => app_path('Admin/bootstrap.php'),
    'route' => [
        'domain' => null,
        'prefix' => env('ADMIN_ROUTE_PREFIX', 'admin'),
        'namespace' => 'App\\Admin\\Controllers',
        'middleware' => ['web', 'admin'],
    ],
    'directory' => app_path('Admin'),
    'https' => env('ADMIN_HTTPS', false),
    'auth' => [
        'controller' => App\Admin\Controllers\AuthController::class,
        'guard' => 'admin',
        'guards' => [
            'admin' => [
                'driver' => 'session',
                'provider' => 'admin',
            ],
        ],
        'providers' => [
            'admin' => [
                'driver' => 'eloquent',
                'model' => AdminUser::class,
            ],
        ],
        'remember' => true,
        //未登录跳转路由
        'redirect_to' => 'view/login',
        //登录成功跳转路由
        'login_redirect' => 'home  ',
        //无需登录的路由
        'excepts' => [
            'login',
            'view/login',
        ],
    ],
    'permission' => [
        'enable' => true,
        'excepts' => [
            'getHeaderToolbar',
            'getMenu',
            'user_setting',
            'login',
            'logout',
            '_handle_action_',
            '_handle_upload_image_',
            'view/*',
        ],
    ],
    'upload' => [
        'disk' => 'public',
        'uniqueName' => false,
        'directory' => [
            'image' => 'images',
            'file' => 'files',
        ],
        'mimes' => 'jpeg,bmp,png,gif,jpg',
    ],
    'database' => [
        'connection' => '',
        'users_table' => 'admin_users',
        'users_model' => AdminUser::class,
        'roles_table' => 'admin_roles',
        'roles_model' => Role::class,
        'permissions_table' => 'admin_permissions',
        'permissions_model' => Permission::class,
        'menu_table' => 'admin_menu',
        'menu_model' => Menu::class,

        'operation_log_table' => 'admin_operation_log',
        'user_permissions_table' => 'admin_user_permissions',
        'role_users_table' => 'admin_role_users',
        'permission_menu_table' => 'admin_permission_menu',
        'role_permissions_table' => 'admin_role_permissions',
        'role_menu_table' => 'admin_role_menu',
    ],
    'check_route_permission' => true,
];
