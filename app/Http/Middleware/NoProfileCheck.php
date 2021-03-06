<?php

namespace App\Http\Middleware;

use Closure;
use App\UserProfile;

class NoProfileCheck
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

        $profile = UserProfile::where('user_id', $user_id)->first();

        if(blank($profile)){
            return redirect(route('result'))->withInput([
                'result' => 'プロフィールが存在しません。',
                'last_insert_id' => null,
                'button' => 'トップページへ戻る'
            ]);
        }

        return $next($request);
    }
}
