<?php

namespace App\Http\Middleware;

use Closure;
use App\UserProfile;
use Illuminate\Support\Facades\Auth;

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
            if(Auth::user()->id === $user_id){
                
                $redirect_page = route('edit_profile');

                return redirect(route('result'))->withInput([
                    'result' => 'プロフィールが存在しません。',
                    'redirect_page' => $redirect_page,
                    'button' => 'プロフィール編集ページへ'
                ]);
            }else{
                $redirect_page = route('home');

                return redirect(route('result'))->withInput([
                    'result' => 'プロフィールが存在しません。',
                    'redirect_page' => $redirect_page,
                    'button' => 'トップページに戻る'
                ]);
            }
        }

        return $next($request);
    }
}
