<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserSession
{

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function handle($request, Closure $next)
    {
        if (!$request->session()->exists('user')) {
            return redirect('/');
        }
        return $next($request);
    }
}
