<?php

use Illuminate\Routing\Router;
use SmallRuralDog\AmisAdmin\Controllers\AdminUserController;
use SmallRuralDog\AmisAdmin\Controllers\AuthController;
use SmallRuralDog\AmisAdmin\Controllers\HandleController;
use SmallRuralDog\AmisAdmin\Controllers\MenuController;
use SmallRuralDog\AmisAdmin\Controllers\PermissionController;
use SmallRuralDog\AmisAdmin\Controllers\RoleController;
use SmallRuralDog\AmisAdmin\Controllers\RootController;

Route::group([
    'domain' => config('amis-admin.route.domain'),
    'prefix' => config('amis-admin.route.prefix', 'admin'),
    'middleware' => config('amis-admin.route.middleware'),
], static function (Router $router) {
    $router->get('/', [RootController::class, "index"]);
    $router->get('view', [RootController::class, "index"]);
    $router->get('view/{name}', [RootController::class, "index"])->where('name', '.*');
    $router->get('getMenu', [HandleController::class, "menu"])->name('amis-admin.getMenu');
    $router->get('getHeaderToolbar', [HandleController::class, 'headerToolbar'])->name('amis-admin.headerToolbar');
    $router->any('_handle_action_', [HandleController::class, 'action'])->name('amis-admin.handle-action');
    $router->post('_handle_upload_image_', [HandleController::class, 'uploadImage'])->name('amis-admin.handle-upload-image');
    $router->post('_handle_upload_file_', [HandleController::class, 'uploadFile'])->name('amis-admin.handle-upload-file');

    $authController = config('amis-admin.auth.controller', AuthController::class);

    $router->resource('login', $authController)->names('amis-admin.login')->only(['index', 'store']);
    $router->get('logout', [$authController, 'logout'])->name('amis-admin.logout');
    $router->any('user_setting', [$authController, 'userSetting'])->name('amis-admin.userSetting');


    $router->resource('admin_users', AdminUserController::class)->names('amis-admin.user');
    $router->resource('menus', MenuController::class)->names('amis-admin.menu');
    $router->resource('roles', RoleController::class)->names('amis-admin.role');
    $router->resource('permissions', PermissionController::class)->names('amis-admin.permission');
    $router->get('permissions_auto_generate', [PermissionController::class, 'autoGenerate'])->name('amis-admin.permission.auto-generate');
});
