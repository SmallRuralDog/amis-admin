<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\HtmlString;

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
    return url($path, $parameters, $secure);
}

function admin_route($path = ''): string
{

    $prefix = trim(config('amis-admin.route.prefix'));
    $path = str_replace($prefix.'/', '/', $path);

    return Str::of($path)->finish('/')->start('/')->rtrim("/")->value();
}


if (!function_exists('admin_asset')) {
    function admin_asset($path): string
    {
        return (config('amis-admin.https') || config('amis-admin.secure')) ? secure_asset($path) : asset($path);
    }
}

function arr2tree($list, $id = 'id', $pid = 'parent_id', $son = 'children'): array
{
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

function vite_assets(): HtmlString
{
    $devServerIsRunning = false;
    if (app()->environment('local')) {
        try {
            Http::get("http://192.168.6.178:3600");
            $devServerIsRunning = true;
        } catch (Exception) {
        }
    }
    if ($devServerIsRunning) {
        return new HtmlString(<<<HTML
            <script type="module" src="http://192.168.6.178:3600/@vite/client"></script>
            <script type="module" src="http://192.168.6.178:3600/resources/js/main.ts"></script>
        HTML
        );
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
