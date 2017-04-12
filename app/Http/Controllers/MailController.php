<?php

namespace App\Http\Controllers;

use App\Mail\orderMail;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;

class MailController extends Controller
{
    public function sendMail(Request $request ,Mailer $mailer){
        $email = $request->email;
        $mailer->to('hainamnguyen1512@gmail.com')->send(new orderMail());
        echo "da gui thanh cong";
    }
}
