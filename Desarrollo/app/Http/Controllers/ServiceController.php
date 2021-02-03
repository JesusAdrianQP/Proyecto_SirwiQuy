<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataBase\ServiceData;

class ServiceController extends Controller
{
    public function serviceall(Request $request){
        return ServiceData::service_list($request);
    }

    public function createservice(Request $request){
        return ServiceData::register($request); 
    }

    public function serviceiddetails(Request $request){
        return ServiceData::listiddetails($request);
    }

    public function pricesdetails(Request $request) 
    {
        return ServiceData::pridetails($request);
    }
    
    public function updateservice(Request $request)
    {   
        return ServiceData::update_service($request);
    }

    public function updateprice(Request $request)
    {   
        return ServiceData::update_price($request);
    }

    public function saveservice(Request $request)
    {
        return ServiceData::save_service($request);
    }

    public function validateFavorite(Request $request)
    {
        return ServiceData::favoriteBoolean($request);
    }
}
