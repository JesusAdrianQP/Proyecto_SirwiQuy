<?php

namespace App\DataBase;

use App\Departamentos;
use App\Provincias;
use App\Distritos;

class DirectionsData
{
    //Listado de departamentos
    public static function listdepa()
    {   //Llamada directa de departamentos ordenados por nombre
        return Departamentos::orderBy('name')->get();
    }

    //listado de provincias
    public static function listprov($id)
    {
        //Llamada directa de obtener provincias ordenadas alfabeticamente por nombre
        return Provincias::where('department_id', '=', $id)->orderBy('name')->get();
    }

    //Listado de distritos
    public static function listdis($id)
    {
        //Llamada directa para obtener distritos ordenadas alfabteicamente por nombre
        return Distritos::where('province_id', '=', $id)->orderBy('name')->get();
    }
}