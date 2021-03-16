<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\AuthentificationController;

class FactureController extends Controller
{
    public function index(Request $request){
        $factures = $this->ListeFacture($request);
        return view('factures.index', compact('factures'));
    }

    public function indexElement(Request $request, $matricule, $element, $ID){
        $user = new UtilisateurController();
        $proprietaireFacture = $user->RechercherUtilisateur($ID,$request, $element);
        $factures = $this->ListeFacureClientSelonMatriculeClient($request, $matricule);
        return view('factures.facture-user', compact('factures', 'proprietaireFacture'));
    }

    private function ListeFacureClientSelonMatriculeClient(Request $request, $matricule){
        $userAuth = new AuthentificationController();
        //akwabasaas/utilisateur
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $login = $user['ap_login_pers'];
        $pwd = $user['ap_pwd_pers'];

        $url = env('APP_URL_SAAS')."facture/client/$matricule?login=$login&pwd=$pwd";

        $factureHTTP = Http::get($url);
        $factures = $factureHTTP->json();

        return $factures;
    }
    
    private function ListeFacture(Request $request){
        $userAuth = new AuthentificationController();
        //akwabasaas/utilisateur
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $login = $user['ap_login_pers'];
        $pwd = $user['ap_pwd_pers'];

        $url = env('APP_URL_SAAS')."facture?login=$login&pwd=$pwd";

        $factureHTTP = Http::get($url);
        $factures = $factureHTTP->json();

        return $factures;
    }
}
