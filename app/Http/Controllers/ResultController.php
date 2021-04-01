<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function result(Request $request)
    {   
        $values = $request->old();

        $message = $values['result'];
        $redirect_page = $values['redirect_page'];
        $button = $values['button'];

        return view('pages.result', [
            'message' => $message,
            'redirect_page' => $redirect_page,
            'button' =>  $button,
        ]);
    }

    public function return_page(Request $request)
    {   
        $redirect_page = $request->redirect_page;
        
        return redirect($redirect_page);
    }
}
