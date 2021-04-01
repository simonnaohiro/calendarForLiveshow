<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSameUser
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
        $poster_id = $request->route()->parameter('poster_id');

        if($poster_id != Auth::user()->id){
            
            $redirect_page = route('home');
            // トップページへ遷移
            return redirect(route('result'))->withInput([
                'result' => '不正な操作です。',
                'redirect_page' => $redirect_page,
                'button' => 'トップページへ戻る'
            ]);
        }

        return $next($request);
    }
}
