<?php

use Illuminate\Support\HtmlString;
use SmallRuralDog\AmisAdmin\Extensions\SettingStorage;

function admin_path($path = ''): string
{
    return ucfirst(config('amis-admin.directory')) . ($path ? DIRECTORY_SEPARATOR . $path : $path);
}

function admin_base_path($path = ''): string
{
    $prefix = '/' . trim(config('amis-admin.route.prefix'), '/');

    $prefix = ($prefix === '/') ? '' : $prefix;

    $path = trim($path, '/');

    if (is_null($path) || $path === '') {
        return $prefix ?: '/';
    }
    return $prefix . '/' . $path;
}

function admin_url($path = '', $parameters = [], $secure = null)
{
    if (URL::isValidUrl($path)) {
        return $path;
    }
    $secure = $secure ?: (config('amis-admin.https') || config('amis-admin.secure'));
    return url(admin_base_path($path), $parameters, $secure);
}

if (!function_exists('route_get')) {
    function route_get($name, $parameters = [], $absolute = true)
    {
        $url = app('url')->route($name, $parameters, $absolute);
        if (config('amis-admin.https')) {
            return str_replace('http://', 'https://', $url);
        }
        return $url;
    }
}

function admin_route($path = ''): string
{

    $prefix = trim(config('amis-admin.route.prefix'));
    $path = str_replace($prefix . '/', '/', $path);

    return Str::of($path)->finish('/')->start('/')->rtrim("/")->toString();
}


if (!function_exists('admin_asset')) {
    function admin_asset($path): string
    {
        return (config('amis-admin.https') || config('amis-admin.secure')) ? secure_asset($path) : asset($path);
    }
}


if (!function_exists('admin_file_url')) {
    function admin_file_url($path)
    {
        if (!$path) {
            return $path;
        }

        if (Str::startsWith($path, ["http://", "https://"])) {
            return $path;
        }
        return Storage::disk(config('admin.upload.disk'))->url($path);
    }
}

if (!function_exists('admin_file_restore_path')) {
    function admin_file_restore_path($url)
    {
        if (!$url) {
            return $url;
        }
        if (Str::startsWith($url, ["http://", "https://"])) {
            $base_url = Storage::disk(config('admin.upload.disk'))->url('');
            $url = str_replace($base_url, '', $url);
        }
        return $url;
    }
}

function arr2tree($list, $id = 'id', $pid = 'parent_id', $son = 'children')
{

    if (!is_array($list)) {
        $list = collect($list)->toArray();
    }

    [$tree, $map] = [[], []];
    foreach ($list as $item) {
        $map[$item[$id]] = $item;
    }

    foreach ($list as $item) {
        if (isset($item[$pid], $map[$item[$pid]])) {
            $map[$item[$pid]][$son][] = &$map[$item[$id]];
        } else {
            $tree[] = &$map[$item[$id]];
        }
    }
    unset($map);
    return $tree;
}

if (!function_exists('settings')) {

    function settings($key = null, $default = null)
    {
        $setting = app()->make(SettingStorage::class);
        if (is_null($key)) {
            return $setting;
        }
        if (is_array($key)) {
            return $setting->set($key);
        }
        return $setting->get($key, value($default));
    }
}

function vite_assets(): HtmlString
{

    if (app()->environment('local')) {
        $devServerIsRunning = false;
        $viteUrl = env("VITE_URL");
        if ($viteUrl) {
            try {
                Http::get($viteUrl);
                $devServerIsRunning = true;
            } catch (Exception) {
            }
            if ($devServerIsRunning) {
                return new HtmlString(<<<HTML
            <script type="module" src="$viteUrl/@vite/client"></script>
            <script type="module" src="$viteUrl/resources/js/main.ts"></script>
        HTML
                );
            }
        }
    }

    $manifest = json_decode(file_get_contents(
        public_path('vendor/admin/manifest.json')
    ), true);
    return new HtmlString(<<<HTML
        <script type="module" src="/vendor/admin/{$manifest['resources/js/main.ts']['file']}"></script>
        <link rel="stylesheet" href="/vendor/admin/{$manifest['resources/js/main.ts']['css'][0]}">
    HTML
    );
}
