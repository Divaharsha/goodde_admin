<?php

namespace App\Http\Controllers\Api\V1;

use App\CentralLogics\DriverLogic;
use App\Http\Controllers\Controller;
use App\Model\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function get_drivers(){
        try {
            return response()->json(Driver::get(), 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }
}
