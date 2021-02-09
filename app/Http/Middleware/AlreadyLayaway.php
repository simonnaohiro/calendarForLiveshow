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

            // 結果画面へ
            return redirect(route('result'))->withInput([
                'result' => $values['performer_name'].' は既にあなたが取り置き済みの出演者です',
                'last_insert_id' => null,
                'button' => 'トップページへ戻る'
            ]);
        }

        return $next($request);
    }
}
