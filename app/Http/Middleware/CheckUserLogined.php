<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserLogined
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
        if(Auth::check()){
            return redirect(route('result'))->withInput([
                'result' => '不正な操作です。',
                'last_insert_id' => null,
                'button' => 'トップページへ戻る'
            ]);
        }
        return $next($request);
    }
}
