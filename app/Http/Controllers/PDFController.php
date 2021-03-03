<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\User;
use App\TicketOnLayaway;
use App\Event;
use PDF;

class PDFController extends Controller
{
    public function index($event_id, $performer)
    {   
        $layaways = TicketOnLayaway::eventId($event_id)->performer($performer)->get();
        $price = Event::price($event_id)->get();
        
        $pdf =  PDF::loadView('pdf', ['layaways' => $layaways, 'price' => $price]);
        return $pdf->stream();
    }
}
