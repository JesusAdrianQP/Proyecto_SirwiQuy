<?php

namespace App\Strategy;

use App\Strategy\Contexto;
use App\Strategy\apis\DNIapi;
use App\Strategy\apis\RUCapi;
use App\Strategy\apis\MAPapi;

class typeAPI
{
    //Retorna la clase a ser instancia
    protected $API = [
        'DNI' => DNIapi::class,
        'RUC' => RUCapi::class,
        'Gmap' => MAPapi::class
    ];
    
    //Funcion que ejecuta el tipo de api que es y retorna el valor obtenido
    //Patron enfocado en el comportamiento
    public function execute($date)
    {
        $strategy = new $this->API[$date->isType];
        $contexto = new Contexto($strategy);//Ejecuta el contexto con la clase ya obtenida
        return $contexto->executeStrategy($date->apidate);
    }
}
