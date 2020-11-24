<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Database\DirectionsData;

class DirectionController extends Controller
{
    //Se obtiene un listado de departamentos
    public static function dep()
    {   //Se retorna en json los departamentos
        return response()->json([
             'departments' => DirectionsData::listdepa()->all()         
         ]);
    }

    //Se obtiene un listado de provincias
    public function prov(Request $request)
    {   //Se retorna en json las provincias
        return response()->json([
            'provinces' => DirectionsData::listprov($request->id)->all()
        ]);  
    }

    //Se obtiene un listado de provincias
    public function dist(Request $request)
    {   //Se retorna en json los distritos
        return response()->json([
            'districts' => DirectionsData::listdis($request->id)->all()
        ]);
    }
}
