<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Library\BaseClass;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function index()
    {
        return view('home');
    }
    
    public function getCalendarDates($year, $month)
    {
        // 正しい年月日を取得
        $ymd = BaseClass::rtn_correct_ymd($year, $month);

        // 格納する変数を宣言
        $dates = [];
        // Carbonで指定するために日時のフォーマットを作成[（Y-m-01）の形]
        $currentDateStr = sprintf('%04d-%02d-01', $ymd['year'], $ymd['month']);
        //引数の前後月を返すメソッド
        $monthes = BaseClass::rtn_ymd_last_and_next($ymd['year'], $ymd['month']);

        // Carbonインスタンスを作成
        $date = new Carbon($currentDateStr);
        // 現在の月のCarbonインスタンスを作成
        $daysOfCurrentMonth = new Carbon($currentDateStr);
        // 現在日を代入
        $currentDay = $daysOfCurrentMonth->now();

        // 月初めの曜日
        $firstDayOfWeek = $date->dayOfWeek;
        // カレンダーを四角形にするため、前月となる左上の隙間用のデータを入れるためずらす
        $date->subDay($firstDayOfWeek);

        // 同上。右下の隙間のための計算。#countの元となる数値を31日固定にしてたが、表示にバグが出てしまったので（一週間分多く表示される場合があった）
        $count = (int)$daysOfCurrentMonth->endOfMonth()->day + $firstDayOfWeek;

        // カレンダーの形を四角形に維持するために一週間単位で出力するための計算(ceil()を使うとfloat型になってしまうのでint型に変換)
        $count = (int)ceil($count / 7) * 7;


        for ($i = 0; $i < $count; $i++, $date->addDay()) {
            // copyしないと全部同じオブジェクトを入れてしまうことになる
            $dates[] = $date->copy();
        }

        return view('calendar', [
            'dates' => $dates, 
            'currentMonth' => $monthes['current'],
            'lastMonth' => $monthes['last'],
            'nextMonth' => $monthes['next'],
            'currentDay' => $currentDay,
            ]);
    }
}
