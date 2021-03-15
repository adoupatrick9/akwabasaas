<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IndexController extends Controller
{
    public function index(){
        //$response = Http::get('http://db/client?login=test&pwd=test');
        //$clients = $response->json();
        //dd($response);
        return view('index');
    }
}
