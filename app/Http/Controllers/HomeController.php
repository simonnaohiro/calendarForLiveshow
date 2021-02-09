<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    
    public function index()
    {
        // ホーム画面をリクエストされたら、現在の年、月を返してカレンダー表示ページにリダイレクト

        $carbon = new Carbon();
        
        $year = $carbon->year;
        $month = $carbon->month;
        return redirect('/home/'.$year.'/'.$month);
    }
}
