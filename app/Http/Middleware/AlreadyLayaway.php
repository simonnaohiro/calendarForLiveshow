<?php

namespace App\Http\Middleware;

use Closure;
use App\TicketOnLayaway;

class AlreadyLayaway
{
    /**
     * 既に取り置き済みの場合、予約が重複しないようにする。
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // リクエストを変数に代入
        $values = $request->old();

        // 取り置き済みのデータを代入
        $already_layaway = TicketOnLayaway::where('event_id', $values['event_id'])
                                            ->where('user_id', $values['user_id'])
                                            ->first();

        // データが存在すれば取り置き済み画面に遷移
        if(filled($already_layaway)){

            // リダイレクト先のページ
            $redirect_page = route('event' ,['event_id' => $values['event_id']]);

            // 結果画面へ
            return redirect(route('result'))->withInput([
                'result' => '既にこのイベントのチケットを取り置いています。',
                'redirect_page' => $redirect_page,
                'button' => 'イベントページへ戻る'
            ]);
        }

        return $next($request);
    }
}
