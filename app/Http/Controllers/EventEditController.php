<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventEditController extends Controller
{
    public function show_event_edit_form($event_id)
    {   
        $event = Event::find($event_id);
        return view('form.eventEditForm', compact('event'));
    }
}
