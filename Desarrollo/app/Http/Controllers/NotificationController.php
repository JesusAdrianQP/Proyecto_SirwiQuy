<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequest;
use Illuminate\Http\Request;
use App\DataBase\NotificationData;

class NotificationController extends Controller
{

    public function createnotification(Request $request){
        return NotificationData::register($request); 
    }

    public function idnotification(Request $request){
        return NotificationData::notiddetails($request); 
    }
    
}
