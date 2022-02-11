<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Install
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(setting('INSTALLED') == 1)
        {
            return abort(403);
        }
        return $next($request);
    }
}
