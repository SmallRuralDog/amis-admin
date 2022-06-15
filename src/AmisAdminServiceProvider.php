<?php

namespace SmallRuralDog\AmisAdmin;

use Arr;
use Illuminate\Support\ServiceProvider;
use SmallRuralDog\AmisAdmin\Components\HeaderToolbar;
use SmallRuralDog\AmisAdmin\Extensions\SettingEloquentStorage;
use SmallRuralDog\AmisAdmin\Extensions\SettingStorage;

class AmisAdminServiceProvider extends ServiceProvider
{

    protected array $commands = [

        Console\InstallCommand::class,

    ];


    protected array $routeMiddleware = [
        'admin.auth' => Middleware\Authenticate::class,

        'admin.bootstrap' => Middleware\Bootstrap::class,
        'admin.session' => Middleware\Session::class,
        'admin.permission' => Middleware\Permission::class,
    ];

    protected array $middlewareGroups = [
        'admin' => [
            'admin.auth',
            'admin.bootstrap',
            'admin.session',
            'admin.permission',
        ],
    ];

    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'small-rural-dog');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'amis-admin');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        if (file_exists($routes = admin_path('routes.php'))) {
            $this->loadRoutesFrom($routes);
        }

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }


    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/amis-admin.php', 'amis-admin');
        $this->loadAdminAuthConfig();
        $this->registerRouteMiddleware();


        // Register the service the package provides.
        $this->app->singleton('amis-admin', function () {
            return new AmisAdmin;
        });
        $this->app->singleton('amis-admin.headerToolbar', HeaderToolbar::class);

        $this->app->bind(SettingStorage::class, SettingEloquentStorage::class);
    }

    public function provides(): array
    {
        return ['amis-admin'];
    }


    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/amis-admin.php' => config_path('amis-admin.php'),
        ], 'amis-admin.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/small-rural-dog'),
        ], 'amis-admin.views');*/

        // Publishing assets.
        $this->publishes([
            __DIR__ . '/../resources/dist' => public_path('vendor/admin'),
        ], 'amis-admin.assets');

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/small-rural-dog'),
        ], 'amis-admin.views');*/

        // Registering package commands.
        $this->commands($this->commands);
    }

    protected function loadAdminAuthConfig(): void
    {
        config(Arr::dot(config('amis-admin.auth', []), 'auth.'));
    }

    protected function registerRouteMiddleware(): void
    {
        foreach ($this->routeMiddleware as $key => $middleware) {
            app('router')->aliasMiddleware($key, $middleware);
        }
        foreach ($this->middlewareGroups as $key => $middleware) {
            app('router')->middlewareGroup($key, $middleware);
        }
    }
}
