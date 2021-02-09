<?php

namespace App\Http\Middleware;

use Closure;

class NoEventCheck
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
        $param = $request->route()->parameter('event_id');

        if(blank($param)){
            return redirect('/');
        }
        return $next($request);
    }
}
