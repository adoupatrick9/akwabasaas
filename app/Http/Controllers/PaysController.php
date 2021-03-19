<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\AuthentificationController;

class PaysController extends Controller
{

    public function ListePays(Request $request){

        if ($request->session()->get('pays')) {
            $pays = $request->session()->get('pays');
        }else{
            $userAuth = new AuthentificationController();
            $user = $userAuth->RecuperationInfosUserConnecte($request);
            $login = $user['ap_login_pers'];
            $pwd = $user['ap_pwd_pers'];
            $urlPays = env('APP_URL_SAAS')."pays?login=$login&pwd=$pwd";
            $paysHTTP = Http::get($urlPays);
            $pays = $paysHTTP->json();
        }

        return $pays;
    }
}
