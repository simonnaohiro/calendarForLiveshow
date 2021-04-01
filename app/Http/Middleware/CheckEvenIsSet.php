<?php

namespace App\Http\Middleware;

use Closure;
use App\Event;

class CheckEvenIsSet
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
        $event_id = $request->route()->parameter('event_id');
        $event = Event::find($event_id);
        
        if($event === null) {

            $redirect_page = route('home');

            return redirect(route('result'))->withInput([
                'result' => '投稿は削除されています。',
                'redirect_page' => $redirect_page,
                'button' => 'トップページへ戻る'
            ]);
        }
        return $next($request);
    }
}
