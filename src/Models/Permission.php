<?php

namespace SmallRuralDog\AmisAdmin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;
use Str;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property array $http_method
 * @property array $http_path
 *
 */
class Permission extends Model
{
    protected $table = "admin_permissions";

    protected $guarded = [];


    public static array $httpMethods = [
        'GET', 'POST', 'PUT', 'DELETE', 'PATCH', 'OPTIONS', 'HEAD',
    ];

    protected $casts = [
        'http_method' => 'array',
        'http_path' => 'array',
    ];

    public function roles(): BelongsToMany
    {
        $pivotTable = config('amis-admin.database.role_permissions_table');
        $relatedModel = config('amis-admin.database.roles_model');

        return $this->belongsToMany($relatedModel, $pivotTable, 'permission_id', 'role_id');
    }

    public function menus(): BelongsToMany
    {
        $pivotTable = config('amis-admin.database.permission_menu_table');

        $relatedModel = config('amis-admin.database.menu_model');

        return $this->belongsToMany($relatedModel, $pivotTable, 'permission_id', 'menu_id')->withTimestamps();
    }

    public function shouldPassThrough(Request $request): bool
    {
        if (empty($this->http_method) && empty($this->http_path)) {
            return true;
        }
        $method = $this->http_method;
        $matches = array_map(function ($path) use ($method) {
            $path = trim(config('amis-admin.route.prefix'), '/') . $path;
            if (Str::contains($path, ':')) {
                [$method, $path] = explode(':', $path);
                $method = explode(',', $method);
            }
            return compact('method', 'path');
        }, $this->http_path);
        foreach ($matches as $match) {
            if ($this->matchRequest($match, $request)) {
                return true;
            }
        }
        return false;
    }

    protected function matchRequest(array $match, Request $request): bool
    {
        if ($match['path'] == '/') {
            $path = '/';
        } else {
            $path = trim($match['path'], '/');
        }
        if (!$request->is($path)) {
            return false;
        }
        $method = collect($match['method'])->filter()->map(function ($method) {
            return strtoupper($method);
        });
        return $method->isEmpty() || $method->contains($request->method());
    }

    protected static function boot(): void
    {
        parent::boot();
        static::deleting(function (Permission $model) {
            $model->roles()->detach();
            $model->menus()->detach();
        });
    }
}
