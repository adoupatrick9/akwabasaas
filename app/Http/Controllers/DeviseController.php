<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\AuthentificationController;
use Illuminate\Http\Response;

class DeviseController extends Controller
{
    public function Listing(Request $request){
        $userAuth = new AuthentificationController();
        //akwabasaas/utilisateur
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $login = $user['ap_login_pers'];
        $pwd = $user['ap_pwd_pers'];

        $url = env('APP_URL_SAAS')."devise?login=$login&pwd=$pwd";

        $deviseHTTP = Http::get($url);
        $devises = $deviseHTTP->json();

        return $devises;

    }

    public function store(Request $request){
        $this->Validation($request);
        $data = $this->Affectation(1, $request); // affectation enregistrement
        $msg = $this->EnregistrementModificationOuSuppression(1,$data,$request);
        return $data;
    }

    public function edit($ID, Request $request){
        $devise = $this->RechercherDevise($ID,$request);
        return $devise;
    }

    public function update(Request $request, $ID){

        $this->Validation($request);
        $data = $this->Affectation(2, $request); // affectation modif
        $msg = $this->EnregistrementModificationOuSuppression(2,$data,$request);
        return $data;

    }

    public function delete(Request $request, $ID){
        $data = $this->RechercherDevise($ID,$request);
        $msg = $this->EnregistrementModificationOuSuppression(3,$data,$request);
        return true;
    }

    private function Validation(Request $request){
        $request->validate([
            "Dev_intitule_devise" => 'required',
        ]);
    }

    private function Affectation(int $action, Request $request){

        $data = array();
        $IDas_devise = 0;
        if ($action == 2) {
            $IDas_devise = Request('IDas_devise');
        }
        $data = $this->RechercherDevise($IDas_devise,$request);

        $data = [
            "IDas_devise" => $IDas_devise,
            "Dev_code_devise" => $data['Dev_code_devise'],
            "Dev_intitule_devise" => Request('Dev_intitule_devise'),
            "Ajoute_le" => $data['Ajoute_le'],
            "Modifie_le" => $data['Modifie_le'],
            "Ajoute_par" => $data['Ajoute_par'],
            "Modifie_par" => $data['Modifie_par'],
            "Date_heure_sys" => $data['Date_heure_sys'],
        ];

        return $data;
    }

    private function EnregistrementModificationOuSuppression(int $action, array $data, Request $request){

        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $loginA = $user['ap_login_pers'];
        $pwdA = $user['ap_pwd_pers'];
        $IDas_devise = $data['IDas_devise'];
        $msg = "";

        /* $datas = json_encode($data);
        dd($datas); */
        if ($action == 1) { // Enregistrement

            $urlEnr = env('APP_URL_SAAS')."devise?login=$loginA&pwd=$pwdA";
            $response = Http::withHeaders([
                'X-Accept' => 'application/json',
            ])->post($urlEnr, $data);
             $msg = "La devise est enregistrée";

        } else if ($action == 2){ // Modification

            $urlMod = env('APP_URL_SAAS')."devise?login=$loginA&pwd=$pwdA";
            $response = Http::put($urlMod, $data);
            $msg = "Devise modifiée";

        }else if ($action == 3) {
            //$urlSup = "api.pierisaas.net/akwabasaas/devise/3?login=ADMIN&pwd=ADMIN";
            $urlSup = env('APP_URL_SAAS')."devise/$IDas_devise?login=$loginA&pwd=$pwdA";
            $response = Http::delete($urlSup, $data);
            $msg = "Devise supprimée";

        }

        return $msg;
    }

    private function RechercherDevise($IDdevise, Request $request){
        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $loginA = $user['ap_login_pers'];
        $pwdA = $user['ap_pwd_pers'];

        $urlSup = env('APP_URL_SAAS')."devise/$IDdevise?login=$loginA&pwd=$pwdA";
        $response = Http::get($urlSup);
        $data = $response->json();

        return $data;
    }
}
