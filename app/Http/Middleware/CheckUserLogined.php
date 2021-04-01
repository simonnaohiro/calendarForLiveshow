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
            $redirect_page = route('home');
            return redirect(route('result'))->withInput([
                'result' => '不正な操作です。',
                'redirect_page' => $redirect_page,
                'button' => 'トップページへ戻る'
            ]);
        }
        return $next($request);
    }
}
