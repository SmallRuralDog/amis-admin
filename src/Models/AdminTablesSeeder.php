<?php

namespace SmallRuralDog\AmisAdmin\Models;

use Illuminate\Database\Seeder;

class AdminTablesSeeder extends Seeder
{
    public function run()
    {
        AdminUser::truncate();
        AdminUser::create([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'name' => '超级管理员',
        ]);
        Role::truncate();
        Role::create([
            'name' => '超级管理员',
            'slug' => 'administrator',
        ]);
        AdminUser::first()->roles()->save(Role::first());

        Permission::truncate();
        collect([
            [
                'name' => '首页',
                'slug' => 'home',
                'http_method' => ['GET'],
                'http_path' => ['/home*'],
                "order" => 1,
                "parent_id" => 0,
            ],
            [
                'name' => '系统',
                'slug' => 'sys-manage',
                "order" => 2,
                "parent_id" => 0,
            ],
            [
                'name' => '权限管理',
                'slug' => 'permissions',
                'http_path' => ["/permissions*"],
                "order" => 3,
                "parent_id" => 2,
            ],
            [
                'name' => '菜单管理',
                'slug' => 'menus',
                'http_path' => ["/menus*"],
                "order" => 4,
                "parent_id" => 2,
            ],
            [
                'name' => '角色管理',
                'slug' => 'roles',
                'http_path' => ["/roles*"],
                "order" => 5,
                "parent_id" => 2,
            ],
            [
                'name' => '后台用户管理',
                'slug' => 'admin_users',
                'http_path' => ["/admin_users*"],
                "order" => 6,
                "parent_id" => 2,
            ],
        ])->each(fn($item) => Permission::create($item));

        Role::first()->permissions()->save(Permission::first());
        Menu::truncate();
        Menu::insert([
            [
                'parent_id' => 0,
                'order' => 1,
                'title' => '仪表盘',
                'icon' => 'fa-solid fa-desktop',
                'uri' => 'home',
                'key' => 'home',
                'uri_type' => 'route',
            ],
            [
                'parent_id' => 0,
                'order' => 2,
                'title' => '系统管理',
                'icon' => 'fa-solid fa-screwdriver-wrench',
                'uri' => '',
                'key' => 'sys',
                'uri_type' => 'route',
            ],
            [
                'parent_id' => 2,
                'order' => 3,
                'title' => '管理员',
                'icon' => '',
                'uri' => 'admin_users',
                'key' => 'admin_users',
                'uri_type' => 'route',
            ],
            [
                'parent_id' => 2,
                'order' => 4,
                'title' => '角色',
                'icon' => '',
                'uri' => 'roles',
                'key' => 'roles',
                'uri_type' => 'route',
            ],
            [
                'parent_id' => 2,
                'order' => 5,
                'title' => '权限',
                'icon' => '',
                'uri' => 'permissions',
                'key' => 'permissions',
                'uri_type' => 'route',
            ],
            [
                'parent_id' => 2,
                'order' => 6,
                'title' => '菜单',
                'icon' => '',
                'uri' => 'menus',
                'key' => 'menus',
                'uri_type' => 'route',
            ]
        ]);
    }
}
