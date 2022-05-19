<?php

namespace SmallRuralDog\AmisAdmin\Middleware;

use Closure;
use Illuminate\Http\Request;

class Session
{
    public function handle(Request $request, Closure $next)
    {
        $path = '/' . trim(config('amis-admin.route.prefix'), '/');
        config(['session.path' => $path]);
        if ($domain = config('amis-admin.route.domain')) {
            config(['session.domain' => $domain]);
        }
        return $next($request);
    }
}
