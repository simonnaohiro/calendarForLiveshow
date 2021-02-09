<?php
namespace App\Library;

use App;
use Carbon\Carbon;

class BaseClass
{
    // 先月、一月後を返す関数(第二引数まで渡したら翌月先月,第三引数まで渡したら翌日前日を返す)
    public static function rtn_ymd_last_and_next($year, $month = null, $day = null)
    {
        if($month === null){
            $str = sprintf('%04d', $year);
            $last = new Carbon($str); 
            $current = new Carbon($str);
            $next = new Carbon($str);

            $last->subYear();
            $next->addYear();
        }else{
            if($day === null){
                $str = sprintf('%04d-%02d', $year, $month);
                $last = new Carbon($str); 
                $current = new Carbon($str);
                $next = new Carbon($str);

                $last->subMonth();
                $next->addMonth();
            }else{
                $str = sprintf('%04d-%02d-%02d', $year, $month, $day);
                
                $last = new Carbon($str); 
                $current = new Carbon($str);
                $next = new Carbon($str);

                $last->subDay();
                $next->addDay();
            }
        }

        return [
            'last' => $last,
            'current' => $current,
            'next' => $next,
        ];
    }

    // 入力された年月日が不正な物の場合、最も近い正しい数値を返す関数
    public static function rtn_correct_ymd($year, $month, $day =null)
    {
        if($year < 0){
            $year = '0';
        }

        if($month > 12){
            $month = '12';
        }elseif($month < 1){
            $month = '1';
        }

        // 月ごとの日数は変化するので、Carbonで月末の日付を取得
        $str = sprintf('%04d-%02d-01', $year, $month);
        $date = new Carbon($str);

        if($day > 31){
            $day = (string)$date->endOfMonth()->day;
        }elseif($day < 1){
            $day = '1';
        }

        return [
            'year' => $year, 'month' => $month, 'day' => $day,
        ];
    }

    // 改行でとハイフンで文章を区切る
    public static function extractKeywords(string $input, int $limit = -1): array
    {
        return preg_split('/[\/\p{Z}\p{Cc}-]++/u', $input, $limit, PREG_SPLIT_NO_EMPTY);
    }
}