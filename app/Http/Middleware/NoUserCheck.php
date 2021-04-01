<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class NoUserCheck
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
        $user_id = $request->route()->parameter('user_id');

        $user = User::find($user_id);

        if(blank($user)){
            $redirect_page = route('home');
            return redirect(route('result'))->withInput([
                'result' => '存在しないユーザーです',
                'redirect_page' => $redirect_page,
                'button' => 'トップページへ戻る'
            ]);
        }
        return $next($request);
    }
}
