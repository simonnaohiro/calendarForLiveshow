<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Mail\LayawayConfirmation;
use Illuminate\Http\Request;
use App\Library\BaseClass;
use Carbon\Carbon;
use App\Event;
use App\User;
use App\TicketOnLayaway;

class EventController extends Controller
{

    // イベント情報の表示
    public function show_event($event_id = null)
    {   

        $logined_user_id = "";
        
        if(isset(Auth::user()->id)){
            $logined_user_id = Auth::user()->id;
        }


        // パラメータの値から登録したイベントを取得
        $event = Event::find($event_id);
        // イベントに保存された投稿者idからユーザー情報を取得
        $poster = User::find($event->post_user_id, ['id' , 'name']);
        // 処理しやすいように、ハイフンごとに日付をスライス
        $ymdt = BaseClass::extractKeywords($event->event_date);

        // 登録されている出演者を特定の文字ごとに切り分ける
        $performers = BaseClass::extractKeywords($event->performers);

        // 投稿者判定、イベント終了判定のための変数を定義
        $same_user = '';
        $ended_at = '';

        // ログイン中のユーザーと投稿者が同じ人の場合
        if($poster->id === $logined_user_id){
            $same_user = true;
        }

        // イベントが終了していた場合
        if(!blank($event->ended_at)){
            $ended_at = true;
        }

        return view('events.event', [
            'event_id' => $event_id,
            'event' => $event,
            'poster' => $poster,
            'ymdt' => $ymdt,
            'performers' => $performers,
            'same_user' => $same_user,
            'ended' => $ended_at,
        ]);
    }

    public function redirect_ticket_on_layaway($event_id, $performer)
    {
        // ユーザーIDを取得
        $user_id = Auth::user()->id;

        return redirect(route('layaway_confirmation'))->withInput([
            'event_id' => $event_id,
            'user_id' => $user_id,
            'performer_name' => $performer,
        ]);
    }


    public function layaway_confirmation(Request $request)
    {
        // redirectで送られてきた値を代入
        $layaway_info = $request->old();

        // save_layawayに渡すため、セッションに格納
        session()->put('layaway_info', $layaway_info);

        // 確認フォームを表示
        return view('events.layaway_confirmation', [
            'performer' => $layaway_info['performer_name'],
        ]);
        
    }

    public function save_layaway()
    {
        // セッションに格納されていた取り置きの値を代入
        $layaway_info = session()->get('layaway_info');
        // セッションの中の値を消す
        session()->put('layaway_info', null);

        // ticket_on_layawaysテーブルのインスタンスを作成
        $layaway = new TicketOnLayaway;

        // DBに保存
        $layaway->fill($layaway_info)->save();
        
        $user = User::find($layaway_info['user_id']);

        \Mail::to($user)->send(new LayawayConfirmation($layaway_info['performer_name']));

        // 結果画面に遷移
        return redirect(route('result'))->withInput([
            'result' => 'チケットを取り置きました',
            'last_insert_id' => null,
            'button' => 'トップページへ戻る'
        ]);
    }

    public function day_event_list($year, $month, $day)
    {
        // パラメーターの値を正しい形式に変換
        $ymd = BaseClass::rtn_correct_ymd($year, $month, $day);

        // 明日と現在日と昨日を配列で代入
        $days = BaseClass::rtn_ymd_last_and_next($ymd['year'], $ymd['month'], $ymd['day']);
        // 年月日を正しいフォーマットに
        $currentDateStr = sprintf('%04d-%02d-%02d', $ymd['year'], $ymd['month'], $ymd['day']);
        // 本日開催のイベント一覧を取得
        $todayEvents = Event::where('event_date', 'LIKE', "{$currentDateStr}%")->get();

        return view('events.events_list', [
            'ymd' => $ymd, 
            'todayEvents' => $todayEvents,
            'today' => $days['current'],
            'yesterday' => $days['last'],
            'tomorrow' => $days['next'],
            ]);
    }


    public function finish_event($event_id, $poster_id)
    {
        $event = Event::find($event_id);
        // 終了確定した日付を保存
        $event->ended_at = Carbon::now();

        $event->save();

        return redirect(route('result'))->withInput([
            'result' => 'イベントを終了いたしました',
            'last_insert_id' => null,
            'button' => 'トップページへ戻る'
        ]);
    }

    public function soft_delete($event_id, $poster_id)
    {   
        $flg = Event::find($event_id)->delete();
            
        if($flg == null){
            return redirect(route('result'))->withInput([
                'result' => 'イベントは存在しません。',
                'last_insert_id' => null,
                'button' => 'トップページへ戻る'
            ]);
        }else{
            return redirect(route('result'))->withInput([
                'result' => '削除が完了しました。',
                'last_insert_id' => null,
                'button' => 'トップページへ戻る'
            ]);
        }
    }

    public function performer_list($event_id)
    {
        $event = Event::find($event_id, ['performers']);
        $performers = BaseClass::extractKeywords($event->performers);


        return view('events.performer_list', compact('performers', 'event_id'));
    }

    public function redirect_layaway_list($event_id, $performer)
    {
        return redirect(route('layaway_list'))->withInput([
            'event_id' => $event_id,
            'performer' => $performer,
        ]);
    }

    public function layaway_list($event_id, $performer)
    {
        $layaways = TicketOnLayaway::event($event_id)->performer($performer)->get();
        $poster = Event::poster($event_id)->first();
        $poster_id = $poster->post_user_id;

        $user_id_list = [];
        foreach($layaways as $layaway) {
            array_push($user_id_list, $layaway->user_id);
        }
        $layaway_users = User::name($user_id_list)->get();

        return view('events.layaway_list', compact('layaway_users', 'event_id', 'performer', 'poster_id'));
    }
}
