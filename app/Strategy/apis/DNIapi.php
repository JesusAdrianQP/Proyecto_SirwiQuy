<?php

namespace App\Strategy\apis;

use App\Strategy\StrategyInterface;

class DNIapi implements StrategyInterface
{
    //Implemento el punto de acceso para obtener el DNI
    //Integracion el sistema de PeruAPIS
    public function execute($api)
    {
        //Token usado para las validaciones DNI - acceso único y privado
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Implc3VzLnF1aXNwZTE3QHVubXNtLmVkdS5wZSJ9.5P0tl9lYO6dAhhezg6HrR0zxXcf72e6KjF4YxOQIeAY';
        //URL construida en base al dni enviado y al token recibido
        $url = 'https://dniruc.apisperu.com/api/v1/dni/'.$api.'?token='.$token;
        $json = file_get_contents($url);//Se obtiene en un archivo los datos obtenidos
        $datos = json_decode($json,true);//Se decodifica y se guarda en un arreglo
        
        return response()->json([$datos, 'success' => 'El DNI ingresado es válido']);
    }
}