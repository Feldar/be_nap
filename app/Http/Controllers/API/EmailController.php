<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{

    public function contact(Request $request){
        $subject = "Asunto del correo";
        $for = "almudena.calderonc@gmail.com";
        Mail::send('email',$request->all(), function($email) use($subject,$for){
            $email->from("cuentaparacosas46@gmail.com","FitChallenge");
            $email->subject($subject);
            $email->to($for);
        });
        return redirect()->back();
    }
}

