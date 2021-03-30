<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Library\BaseClass;
use Validator;

class EventEditController extends Controller
{

    public function __construct()
    {
        $this->middleware('verified');
    }

    public function show_event_edit_form($event_id)
    {   
        $event = Event::find($event_id);
        $date_string = $event->event_date;
        $event_date = str_replace(' ', "T", $date_string);

        return view('form.eventEditForm', compact('event', 'event_date', 'event_id'));
    }

    public function register_edit_event(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_date' => 'required',
            'event_title' => 'required|string|max:255',
            'price' => 'nullable|integer',
            'contents' => 'required|string|max:10000',
            'performers' => 'required|string|max:300',
            'event_image' => 'nullable|image',
            'event_id' => 'required',
        ]);

        if($validator->fails()){
            return redirect(route('event_edit' ,['event_id' => $request->event_id]))
                ->withErrors($validator)
                ->withInput();
        }

        return redirect(route('post_edit_event'))->withInput($request->all);
    }

    public function post_edit(Request $request)
    {
        $edit_info = $request->old();
        $event = Event::find($edit_info['event_id']);

        // dd($edit_info);
        $event->fill($edit_info)->save();

        return redirect(route('result'))->withInput([
            'result' => 'イベント内容を変更しました。',
            'last_insert_id' => $request->event_id,
            'button' => 'イベントページへ'
        ]);
    }
}
