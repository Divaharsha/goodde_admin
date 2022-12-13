<?php

namespace App\CentralLogics;

use App\Model\Driver;

class DriverLogic
{
    public static function get_drivers()
    {
        return Driver::latest()->get();
    }
}
