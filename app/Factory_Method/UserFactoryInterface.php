<?php

namespace App\Factory_Method;

use InvalidArgumentException;

interface UserFactoryInterface
{
    public static function make($identity): UserInterface;
}