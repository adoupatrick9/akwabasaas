<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DeviseController;

class ConfigurationController extends Controller
{
    public function index(Request $request){

        $dev = new DeviseController();
        $devises = $dev->Listing($request);

        return view("configuration", compact('devises'));
    }
}
