<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataBase\CommunicationData;

class CommunicationController extends Controller
{
    public function requestService(Request $request)
    {
        return CommunicationData::request($request);
    }

    public function notifications_id(Request $request)
    {
        return CommunicationData::list_not($request);
    }

    public function deleterequests(Request $request)
    {
        return CommunicationData::delete_request($request);
    }

    public function details(Request $request)
    {
        return CommunicationData::notiddetails($request); 
    }

    public function update_status(Request $request)
    {
        return CommunicationData::status($request);
    }

    public function acept(Request $request)
    {
        return CommunicationData::acept_request($request);
    }

    public function responsedetails(Request $request)
    {
        return CommunicationData::response_details($request);
    }

    public function list_response(Request $request)
    {
        return CommunicationData::listResponse($request);
    }
}
