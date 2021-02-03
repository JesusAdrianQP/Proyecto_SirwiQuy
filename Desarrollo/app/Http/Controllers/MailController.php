<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Service;
use App\Customer;
use App\Mail\RegisterCheck;
use App\Mail\MessageCheck;
use App\Mail\Message_Reset;
use App\Mail\Message_Deny;
use App\Mail\Message_Acept;
use App\Mail\Message_Pay;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function welcome($user, $email, $pass)
    {
        Mail::to($email)->send(new RegisterCheck($user, $email, $pass));

        return response()->json(['success' => ['Credenciales enviadas a su correo']], 200);
    }

    public function message($request, $email)
    {
        Mail::to($email)->send(new MessageCheck($request));
    }

    public function message_deny($service, $customer, $date)
    {
        Mail::to($customer->email)->send(new Message_Deny($service, $date));
    }

    public function message_acept($response, $customer)
    {
        Mail::to($customer)->send(new Message_Acept($response));
    }

    public function message_pay($email1, $email2, $pay)
    {
        Mail::to($email1)->send(new Message_Pay($pay));

        Mail::to($email2)->send(new Message_Pay($pay));
    }

    public function reset($objUser, $ide)
    {
        Mail::to($objUser->email)->send(new Message_Reset($objUser, $ide));
    }
}
