<?php

namespace App\Strategy;

use App\Strategy\StrategyInterface; 

class Contexto
{
    private $strategy;

    public function __construct(StrategyInterface $strategy){
        $this->strategy = $strategy;//Se instancia un constructor
    }

    //Revela comportamiento y elige entre sus opciones
    public function executeStrategy($apidate){
        return $this->strategy->execute($apidate);
    }
}