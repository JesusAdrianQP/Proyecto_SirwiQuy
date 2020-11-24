<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Service;
use App\Customer;
use App\Mail\RegisterCheck;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function welcome($user, $email, $pass){
        Mail::to($email)->send(new RegisterCheck($user, $email, $pass));

        return response()->json(['success' => ['Sus credenciales han sido mandadas al correo proporcionado']], 200);
    }
}
