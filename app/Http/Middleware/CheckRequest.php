<?php

namespace App\Http\Middleware;

use Closure;

class CheckRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * リクエストがない場合の画面の遷移
     */
    public function handle($request, Closure $next)
    {
        // リクエストがなかった場合
        if(blank($request->old())){
            // リクエストがなかったら結果画面に遷移
            return redirect(route('result'))->withInput([
                'result' => 'エラーです。やり直してください。',
                'last_insert_id' => null,
                'button' => 'トップページへ戻る'
            ]);
        }

        return $next($request);
    }
}
