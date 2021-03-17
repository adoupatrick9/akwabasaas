<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\ServiceClientController;

class IndexController extends Controller
{
    public function index(Request $request){
       /* $servC = new ServiceClientController();
       $services = $servC->ListeServicesClient($request); */


        return view('index');
    }
}
