<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\TicketOnLayaway;
use PDF;

class PDFController extends Controller
{
    public function index($event_id, $performer, $poster_id)
    {   
        $layaways = TicketOnLayaway::event($event_id)->performer($performer)->get();
        
        $pdf =  PDF::loadView('pdf', ['layaways' => $layaways]);
        return $pdf->stream();
    }
}
