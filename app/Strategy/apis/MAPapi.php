<?php

namespace App\Strategy\apis;

use App\Strategy\StrategyInterface;

class MAPapi implements StrategyInterface
{
    //Implemento el punto de acceso para obtener las coordenadas de mi mapa
    public function execute($api)
    {
        //Token usado para acceder a google maps
        $token = 'AIzaSyBY5EBnrcArkgAZqd1o0TeEqYDgZe0985I';
        //URL construida en base a la direcciones enviadas
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?address=Distrito+'.$api.'+Lima,Lima,Peru&key='.$token;
        $json = file_get_contents($url);//Se obtiene en un archivo los datos obtenidos
        $datos = json_decode($json,true);//Se decodifica y se guarda en un arreglo
        
        return response()->json([$datos]);
    }
}