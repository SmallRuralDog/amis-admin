<?php

namespace SmallRuralDog\AmisAdmin\Middleware;

use AmisAdmin;
use Closure;

class Authenticate
{
    public function handle($request, Closure $next)
    {
        $redirectTo = admin_base_path(config('amis-admin.auth.redirect_to', 'view/login'));


        if (!$this->shouldPassThrough($request) && AmisAdmin::guard()->guest()) {
            return redirect()->guest($redirectTo);
        }

        return $next($request);
    }

    protected function shouldPassThrough($request): bool
    {
        $excepts = config('amis-admin.auth.excepts', [
            'login',
            'view/login',
            'logout',
        ]);

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
