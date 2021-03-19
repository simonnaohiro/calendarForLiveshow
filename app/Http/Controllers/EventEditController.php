<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventEditController extends Controller
{
    public function show_event_edit_form($event_id)
    {   
        $event = Event::find($event_id);
        $date_string = $event->event_date;
        $event_date = str_replace(' ', "T", $date_string);

        return view('form.eventEditForm', compact('event', 'event_date'));
    }
}
