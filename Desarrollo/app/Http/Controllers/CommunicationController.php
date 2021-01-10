<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataBase\CommunicationData;

class CommunicationController extends Controller
{
    public function requestService(Request $request){
        return CommunicationData::request($request);
    }
}
