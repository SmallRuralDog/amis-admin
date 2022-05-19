<?php

namespace SmallRuralDog\AmisAdmin\Middleware;

use AmisAdmin;
use Closure;
use Illuminate\Http\Request;
use InvalidArgumentException;
use SmallRuralDog\AmisAdmin\Models\Permission as Checker;
use SmallRuralDog\AmisAdmin\Renderers\Alert;
use Str;

class Permission
{
    protected string $middlewarePrefix = 'admin.permission:';

    public function handle(Request $request, Closure $next, ...$args)
    {
        if (config('admin.check_route_permission') === false) {
            return $next($request);
        }
        if (
            !empty($args)
            || !config('amis-admin.permission.enable')
            || $this->shouldPassThrough($request)
            || $this->checkRoutePermission($request)
            || AmisAdmin::user()?->isAdministrator()
        ) {
            return $next($request);
        }

        if (!AmisAdmin::user()?->allPermissions()->first(function (Checker $permission) use ($request) {
            return $permission->shouldPassThrough($request);
        })) {
            if ($request->isMethod('get')) {
                return AmisAdmin::response(Alert::make()->body("您没有权限访问该页面")->level("danger")->showIcon(true)->showCloseButton(false));
            }
            return AmisAdmin::responseError("没有权限");
        }

        return $next($request);
    }

    public function checkRoutePermission(Request $request): bool
    {
        if (!$middleware = collect($request->route()?->middleware())->first(function ($middleware) {
            return Str::startsWith($middleware, $this->middlewarePrefix);
        })) {
            return false;
        }

        $args = explode(',', str_replace($this->middlewarePrefix, '', $middleware));

        $method = array_shift($args);

        if (!method_exists(Checker::class, $method)) {
            throw new InvalidArgumentException("Invalid permission method [$method].");
        }

        call_user_func([Checker::class, $method], $args);

        return true;
    }

    protected function shouldPassThrough($request): bool
    {
        $excepts = config('amis-admin.permission.excepts', []);

        return collect($excepts)
            ->map('admin_base_path')
            ->contains(function ($except) use ($request) {
                if ($except !== '/') {
                    $except = trim($except, '/');
                }
                return $request->is($except);
            });
    }
}
