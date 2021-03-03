<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Event;
use App\User;
use Validator;


class EventRegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('verified');
    }
    
    // ミドルウェアで修正予定
    public function event_form($year = '', $month = '', $day='')
    {
        $poster_id = auth()->user()->id;
        if(blank($year) && blank($month) && blank($day)){
            $default_time = Carbon::today()->format('Y-m-d\TH:i');
        }else{
            if(strlen($day) == 1){
                $default_time = $year.'-'.$month.'-0'.$day.'T00:00';
            }else{
                $default_time = $year.'-'.$month.'-'.$day.'T00:00';
            }
        }
        
        return view('form.eventRegisterForm', compact('poster_id', 'default_time'));
    }

    public function register_event(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_date' => 'required',
            'event_title' => 'required|string|max:255',
            'price' => 'nullable|integer',
            'contents' => 'required|string|max:10000',
            'performers' => 'required|string|max:300',
            'event_image' => 'nullable|image',
            'post_user_id' => 'required|integer',
        ]);
            

        if ($validator->fails()) {
            return redirect('/event/register')
                        ->withErrors($validator)
                        ->withInput();
        }

        $event = [
            'post_user_id' => $request->post_user_id,
            'event_date' => $request->event_date,
            'event_title' => $request->event_title,
            'contents' => $request->contents,
            'price' => (int)$request->price,
            'event_image' => $request->event_image,
            'performers' => $request->performers,
        ];

        return redirect('/event/preview/confirm')->withInput($event);
    }

    public function preview(Request $request)
    {   

        $event = $request->old();
        $poster = User::find($event['post_user_id']);

        return view('events.preview', compact('event', 'poster'));
    }

    public function post_event(Request $request)
    {

        $event = new Event();

        $event_info = [
            'post_user_id' => $request->post_user_id,
            'event_date' => $request->event_date,
            'event_title' => $request->event_title,
            'price' => (int)$request->price,
            'contents' => $request->contents,
            'event_image' => $request->event_image,
            'performers' => $request->performers,
        ];
        
        $event->fill($event_info)->save();

        $last_insert_id = $event->id;

        return redirect(route('result'))->withInput([
            'result' => '投稿が完了しました。',
            'last_insert_id' => $last_insert_id,
            'button' => '投稿したページへ'
        ]);
    }

    public function result(Request $request)
    {   
        $values = $request->old();

        $message = $values['result'];
        $last_insert_id = $values['last_insert_id'];
        $button = $values['button'];

        return view('pages.result', [
            'message' => $message,
            'last_insert_id' => $last_insert_id,
            'button' =>  $button,
        ]);

    }

    public function return_page(Request $request)
    {   
        $last_insert_id = $request->last_insert_id;
        
        return redirect(route('event', [
            'event_id' => $last_insert_id,
            ]));
    }
}
