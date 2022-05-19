<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function getConnection()
    {
        return config('amis-admin.database.connection') ?: config('database.default');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('amis-admin.database.users_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 190)->unique();
            $table->string('password', 60);
            $table->string('name');
            $table->string('avatar')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        });
        Schema::create(config('amis-admin.database.roles_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->string('slug', 50)->unique();
            $table->timestamps();
        });
        Schema::create(config('amis-admin.database.permissions_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->string('slug', 50)->unique();
            $table->string('http_method')->nullable();
            $table->text('http_path')->nullable();
            $table->integer('order');
            $table->integer('parent_id');
            $table->timestamps();
        });
        Schema::create(config('amis-admin.database.menu_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->integer('order')->default(0);
            $table->string('title', 50);
            $table->string('key', 50);
            $table->string('icon', 50);
            $table->string('uri', 50);
            $table->string('uri_type', 50);
            $table->string('target', 50);
            $table->boolean('hidden');
            $table->json('params');

            $table->timestamps();
        });

        Schema::create(config('amis-admin.database.role_users_table'), function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('user_id');
            $table->index(['role_id', 'user_id']);
            $table->timestamps();
        });
        Schema::create(config('amis-admin.database.role_permissions_table'), function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('permission_id');
            $table->index(['role_id', 'permission_id']);
            $table->timestamps();
        });
        Schema::create(config('amis-admin.database.role_menu_table'), function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('menu_id');
            $table->index(['role_id', 'menu_id']);
            $table->timestamps();
        });
        Schema::create(config('amis-admin.database.permission_menu_table'), function (Blueprint $table) {
            $table->integer('permission_id');
            $table->integer('menu_id');
            $table->index(['permission_id', 'menu_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('amis-admin.database.users_table'));
        Schema::dropIfExists(config('amis-admin.database.roles_table'));
        Schema::dropIfExists(config('amis-admin.database.permissions_table'));
        Schema::dropIfExists(config('amis-admin.database.menu_table'));
        Schema::dropIfExists(config('amis-admin.database.role_users_table'));
        Schema::dropIfExists(config('amis-admin.database.role_permissions_table'));
        Schema::dropIfExists(config('amis-admin.database.role_menu_table'));
        Schema::dropIfExists(config('amis-admin.database.permission_menu_table'));
    }
};
