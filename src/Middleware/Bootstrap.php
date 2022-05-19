<?php

namespace SmallRuralDog\AmisAdmin\Middleware;

use AmisAdmin;
use Closure;
use Illuminate\Http\Request;

class Bootstrap
{
    public function handle(Request $request, Closure $next)
    {
        AmisAdmin::bootstrap();

        return $next($request);
    }

}
