<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Log;

class AdminAuthenticate extends Authenticate
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('admin.login');
        }
    }

    public function handle($request, Closure $next, ...$guards)
    {
        $guards = ['admin'];
        $this->authenticate($request, $guards);

        return $next($request);
    }
}
