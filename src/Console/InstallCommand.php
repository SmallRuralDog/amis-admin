<?php

namespace SmallRuralDog\AmisAdmin\Console;

use Illuminate\Console\Command;
use SmallRuralDog\AmisAdmin\Models\AdminTablesSeeder;

class InstallCommand extends Command
{
    protected $signature = 'amis-admin:install';

    protected $description = '安装 AmisAdmin';

    protected string $directory = '';

    public function handle(): void
    {
        $this->initDatabase();
        $this->initAdminDirectory();
    }

    public function initDatabase(): void
    {
        $this->call('migrate', [
            '--path' => dirname(dirname(__DIR__)) . '/database/migrations',
        ]);
        $userModel = config('amis-admin.database.users_model');
        if ($userModel::count() == 0) {
            if ($userModel::count() == 0) {
                $this->call('db:seed', ['--class' => AdminTablesSeeder::class]);
            }

        }
    }

    protected function initAdminDirectory(): void
    {
        $this->directory = config('amis-admin.directory');

        if (is_dir($this->directory)) {
            $this->line("<error>{$this->directory} directory already exists !</error> ");
            return;
        }
        $this->makeDir('/');
        $this->line('<info>Admin directory was created:</info> ' . str_replace(base_path(), '', $this->directory));
        $this->makeDir('Controllers');
        $this->createHomeController();
        $this->createAuthController();
        $this->createSettingsController();

        $this->createBootstrapFile();
        $this->createRoutesFile();
    }

    public function createHomeController(): void
    {
        $homeController = $this->directory . '/Controllers/HomeController.php';
        $contents = $this->getStub('HomeController');
        $this->laravel['files']->put(
            $homeController,
            str_replace('DummyNamespace', config('amis-admin.route.namespace'), $contents)
        );
        $this->line('<info>HomeController file was created:</info> ' . str_replace(base_path(), '', $homeController));
    }

    public function createAuthController(): void
    {
        $authController = $this->directory . '/Controllers/AuthController.php';
        $contents = $this->getStub('AuthController');
        $this->laravel['files']->put(
            $authController,
            str_replace('DummyNamespace', config('amis-admin.route.namespace'), $contents)
        );
        $this->line('<info>AuthController file was created:</info> ' . str_replace(base_path(), '', $authController));
    }

    public function createSettingsController(): void
    {
        $authController = $this->directory . '/Controllers/SettingsController.php';
        $contents = $this->getStub('SettingsController');
        $this->laravel['files']->put(
            $authController,
            str_replace('DummyNamespace', config('amis-admin.route.namespace'), $contents)
        );
        $this->line('<info>SettingsController file was created:</info> ' . str_replace(base_path(), '', $authController));
    }

    protected function createBootstrapFile(): void
    {
        $file = $this->directory . '/bootstrap.php';
        $contents = $this->getStub('bootstrap');
        $this->laravel['files']->put($file, $contents);
        $this->line('<info>Bootstrap file was created:</info> ' . str_replace(base_path(), '', $file));
    }

    protected function createRoutesFile(): void
    {
        $file = $this->directory . '/routes.php';
        $contents = $this->getStub('routes');
        $this->laravel['files']->put($file, str_replace('DummyNamespace', config('amis-admin.route.namespace'), $contents));
        $this->line('<info>Routes file was created:</info> ' . str_replace(base_path(), '', $file));
    }

    protected function getStub($name): string
    {
        return $this->laravel['files']->get(__DIR__ . "/stubs/$name.stub");
    }

    protected function makeDir($path = ''): void
    {
        $this->laravel['files']->makeDirectory("{$this->directory}/$path", 0755, true, true);
    }
}
