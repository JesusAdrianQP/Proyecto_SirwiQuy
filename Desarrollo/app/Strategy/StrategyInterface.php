<?php

namespace App\Strategy;

interface StrategyInterface
{
    public function execute($api);//Hereda a ambas clases que se conectan con las APIS
}