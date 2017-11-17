<?php

namespace SigeTurbo\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use SigeTurbo\Acl;


class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!getGuest()) {
            if (!Acl::isAllow(Route::currentRouteName(), getUser()->role_selected)) {
                App::abort(401, 'Unauthorized');
            }
        }
        return $next($request);
    }
}
