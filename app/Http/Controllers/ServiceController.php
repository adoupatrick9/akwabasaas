<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\CoutServiceController;
use App\Http\Controllers\AuthentificationController;

class ServiceController extends Controller
{
    public function index(Request $request){
        $userAuth = new AuthentificationController();
        //akwabasaas/utilisateur
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $login = $user['ap_login_pers'];
        $pwd = $user['ap_pwd_pers'];

        $url = env('APP_URL_SAAS')."service?login=$login&pwd=$pwd";

        $serviceHTTP = Http::get($url);
        $services = $serviceHTTP->json();

        //dd($services);

        return view('services.index', compact('services'));

    }

    public function store(Request $request){
        $this->Validation($request);
        $data = $this->Affectation(1, $request); // affectation enregistrement
        $msg = $this->EnregistrementModificationOuSuppression(1,$data,$request);
        return $data;
    }

    public function edit($ID, Request $request){
        $service = $this->RechercherService($ID,$request);
        return $service;
    }

    public function update(Request $request, $ID){
        $this->Validation($request);
        $data = $this->Affectation(2, $request); // affectation modif
        $msg = $this->EnregistrementModificationOuSuppression(2,$data,$request);
        return $data;
    }

    public function delete(Request $request, $ID){
        $data = $this->RechercherService($ID,$request);
        $msg = $this->EnregistrementModificationOuSuppression(3,$data,$request);
        return $data;
    }

    private function Validation(Request $request){
        $request->validate([
            "sce_nom_service" => 'required',
            "sce_type" => 'required',
        ]);
    }

    private function Affectation(int $action, Request $request){
        $data = array();
        $idas_service = 0;
        if ($action == 2) {
            $idas_service = Request('idas_service');
        }
        $data = $this->RechercherService($idas_service,$request);
        $sce_nom = Request('sce_nom_service');
        $sce_type = Request('sce_type');
        $Sce_code = $data['sce_code_service'];
        $ajoute_le = $data['ajoute_le'];
        $modifie_le = $data['modifie_le'];
        $ajoute_par = $data['ajoute_par'];
        $modifie_par = $data['modifie_par'];
        $date_heure_sys = $data['date_heure_sys'];
        $data = [
            "idas_service" => $idas_service,
            "sce_code_service" => $Sce_code,
            "Sce_nom_service" => $sce_nom,
            "Sce_type_service" => $sce_type,
            "ajoute_le" => $ajoute_le,
            "modifie_le" => $modifie_le,
            "ajoute_par" => $ajoute_par,
            "modifie_par" => $modifie_par,
            "date_heure_sys" => $date_heure_sys
        ];
        return $data;
    }

    private function EnregistrementModificationOuSuppression(int $action, array $data, Request $request){

        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $loginA = $user['ap_login_pers'];
        $pwdA = $user['ap_pwd_pers'];
        $idas_service = $data['idas_service'];
        $msg = "";

        //dd($loginA, $pwdA);
        if ($action == 1) { // Enregistrement

            $urlEnr = env('APP_URL_SAAS')."service?login=$loginA&pwd=$pwdA";
            Http::withHeaders([
                'X-Accept' => 'application/json',
            ])->post($urlEnr, $data);
             $msg = "Le service a bien été enregistré.";

        } else if ($action == 2){ // Modification

            $urlMod = env('APP_URL_SAAS')."service?login=$loginA&pwd=$pwdA";
            Http::put($urlMod, $data);
            $msg = "Le service a bien été modifié.";

        }else if ($action == 3) {
            //$urlSup = "api.pierisaas.net/akwabasaas/service/3?login=ADMIN&pwd=ADMIN";
            $urlSup = env('APP_URL_SAAS')."service/$idas_service?login=$loginA&pwd=$pwdA";
            Http::delete($urlSup, $data);
            $msg = "Le service a bien été supprimé.";

        }

        return $msg;
    }

    public function RechercherService($IDservice, Request $request){
        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $loginA = $user['ap_login_pers'];
        $pwdA = $user['ap_pwd_pers'];

        $urlSup = env('APP_URL_SAAS')."service/$IDservice?login=$loginA&pwd=$pwdA";
        $response = Http::get($urlSup);
        $data = $response->json();

        return $data;
    }

    public function actif($ID, Request $request){

        $data = $this->RechercherService($ID,$request);

        $choix = "";
        if ($data['sce_inactif'] == false) {
            $data['sce_inactif'] = true;
            $choix = "inactif";
        }else if ($data['sce_inactif'] == true) {
            $data['sce_inactif'] = false;
            $choix = "actif";
        }

        $msg = $this->EnregistrementModificationOuSuppression(2,$data,$request);

        return back()->with("message", "Le service à bien été marqué ".$choix);
    }

    public function ListeServices(Request $request){
        $userAuth = new AuthentificationController();
        //akwabasaas/utilisateur
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $login = $user['ap_login_pers'];
        $pwd = $user['ap_pwd_pers'];

        $url = env('APP_URL_SAAS')."service?login=$login&pwd=$pwd";

        $serviceHTTP = Http::get($url);
        $services = $serviceHTTP->json();

        return $services;
    }

    public function coutservice(Request $request, $ID){
        $dev = new DeviseController(); $cout_serv = new CoutServiceController();
        $coutServices = $cout_serv->ListeCoutServiceSelonIDService($request, $ID);
        $service = $this->RechercherService($ID, $request);
        $devises = $dev->Listing($request);
        return view('couts-service.index', compact('coutServices', 'service', 'devises'));
    }

}
