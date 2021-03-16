<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\AuthentificationController;

class ServiceClientController extends Controller
{
    public function index(Request $request){
        $userAuth = new AuthentificationController();
        //akwabasaas/serviceclient
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $login = $user['Us_login'];
        $pwd = $user['Us_mot_de_passe'];

        $url = env('APP_URL_SAAS')."serviceclient?login=$login&pwd=$pwd";

        $userHTTP = Http::get($url);
        $users = $userHTTP->json();

        return view('serviceclients.index', compact('users'));
    }

    public function storeAff(Request $request, $IDclient){

        Request()->validate([
            "Sce_code_service"=>"required",
        ]);

        $user = new UtilisateurController();
        $client = $user->RechercherUtilisateur($IDclient, $request, 'client');

        $CodeService = Request('Sce_code_service');
        $MatriculeClient = $client['ap_matricule_pers'];

         $userAuth = new AuthentificationController();
        //akwabasaas/serviceclient
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $login = $user['ap_login_pers'];
        $pwd = $user['ap_pwd_pers'];

        $url = env('APP_URL_SAAS')."service/$CodeService/$MatriculeClient?login=$login&pwd=$pwd";

        $serviceclientHTTP = Http::get($url);
        $serviceclients = $serviceclientHTTP->json();

        $vue = "/utilisateurs-service/".$IDclient."/client";
        return redirect($vue)->with("message", "Service client enregistré");

    }
    public function store(Request $request, $IDclient){

        //dd($IDclient);
        $this->Validation($request);
        $data = $this->Affectation(1, $request, $IDclient); // affectation enregistrement
        $msg = $this->EnregistrementModificationOuSuppression(1,$data,$request);

        if ($msg != "") {
            $vue = "/utilisateurs-service/".$IDclient."/client";
            return redirect($vue)->with("message", $msg);
        }

    }

    public function edit($ID, Request $request, $IDclient){
        $data = $this->Rechercherserviceclient($ID,$request);
        return view('serviceclients.edit', compact('data', 'IDclient'));
    }

    public function update(Request $request, $ID, $IDclient){

        $this->Validation($request);
        $data = $this->Affectation(2, $request, $IDclient); // affectation modif
        $msg = $this->EnregistrementModificationOuSuppression(2,$data,$request);

        if ($msg != "") {
            $vue = "/utilisateurs-service/".$IDclient."/client";
            return redirect($vue)->with("message", $msg);
        }

    }

    public function delete(Request $request, $ID, $IDclient){

        $data = $this->Rechercherserviceclient($ID,$request);
        $msg = $this->EnregistrementModificationOuSuppression(3,$data,$request);

        if ($msg != "") {
            $vue = "/utilisateurs-service/".$IDclient."/client";
            return redirect($vue)->with("message", $msg);
        }

    }

    private function Validation(Request $request){

        $request->validate([
            'sc_periodicite' => 'required',
            'sc_fin_service' => 'required',
            'sc_date_souscription' => 'required',
            'sc_debut_souscription' => 'required',
            'sc_fin_souscription' => 'required',
            'sc_option_facturation' => 'required',
            'sc_quantite' => 'required',
            'sc_cout_service' => 'required',
            'Sce_code_service' => 'required',
        ]);
    }

    private function Affectation(int $action, Request $request, $IDclient){

        $data = array();
        $idas_service_client = 0;
        if ($action == 2) {
            $idas_service_client = Request('idas_service_client');
        }

        $data = $this->Rechercherserviceclient($idas_service_client,$request);

        $data = [
            "idas_service_client" => $idas_service_client,
            "Sc_numero_serviceclient" => $data['Sc_numero_serviceclient'],
            "sc_periodicite" => Request('sc_periodicite'),
            "sc_debut_service" => Request('sc_debut_service'),
            "sc_fin_service" => Request('sc_fin_service'),
            "sc_date_souscription" => Request('sc_date_souscription'),
            "sc_debut_souscription" => Request('sc_debut_souscription'),
            "sc_fin_souscription" => Request('sc_fin_souscription'),
            "sc_option_facturation" => Request('sc_option_facturation'),
            "sc_quantite" => Request('sc_quantite'),
            "sc_cout_service" => Request('sc_cout_service'),
            "Sce_code_service" => Request('Sce_code_service'),
            "Cli_reference" => $IDclient,
            "ajoute_le" => $data['ajoute_le'],
            "modifie_le" => $data['modifie_le'],
            "ajoute_par" => $data['ajoute_par'],
            "modifie_par" => $data['modifie_par'],
            "date_heure_sys" => $data['date_heure_sys'],
            "sce_type_service" => $data['sce_type_service'],
            "sce_nom_service" => $data['sce_nom_service'] ,
            "ap_nom_pers" => $data['ap_nom_pers'] ,
            "ap_email_pers" => $data['ap_email_pers'] ,
            "ap_mobile_pers" => $data['ap_mobile_pers'] ,
            "Sc_licence_cle_physique" => Request('Sc_licence_cle_physique') ,
            "Sc_licence_cle_fourni" => Request('Sc_licence_cle_fourni') ,
            "Sc_licence_nombre" => Request('Sc_licence_nombre') ,
            "Sc_montant_remise" => Request('Sc_montant_remise') ,
            "Sce_modalitepaiement" => Request('Sce_modalitepaiement') ,

        ];

        //dd($data);
        return $data;
    }

    private function EnregistrementModificationOuSuppression(int $action, array $data, Request $request){

        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $loginA = $user['ap_login_pers'];
        $pwdA = $user['ap_pwd_pers'];
        $IDserviceclient = $data['idas_service_client'];
        $msg = "";

        //dd($data);
        //dd($loginA, $pwdA);
        if ($action == 1) { // Enregistrement

            $urlEnr = env('APP_URL_SAAS')."serviceclient?login=$loginA&pwd=$pwdA";
            $response = Http::withHeaders([
                'X-Accept' => 'application/json',
            ])->post($urlEnr, $data);
             $msg = "Service client enregistré.";

        } else if ($action == 2){ // Modification

            $urlMod = env('APP_URL_SAAS')."serviceclient?login=$loginA&pwd=$pwdA";
            Http::put($urlMod, $data);
            $msg = "Service client modifié.";

        }else if ($action == 3) {
            //$urlSup = "api.pierisaas.net/akwabasaas/serviceclient/3?login=ADMIN&pwd=ADMIN";
            $urlSup = env('APP_URL_SAAS')."serviceclient/$IDserviceclient?login=$loginA&pwd=$pwdA";
            Http::delete($urlSup, $data);
            $msg = "Service client supprimé.";

        }

        return $msg;
    }

    private function Rechercherserviceclient($IDserviceclient, Request $request){
        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
       $loginA = $user['ap_login_pers'];
        $pwdA = $user['ap_pwd_pers'];

        $urlSup = env('APP_URL_SAAS')."serviceclient/$IDserviceclient?login=$loginA&pwd=$pwdA";
        $response = Http::get($urlSup);
        $data = $response->json();

        return $data;
    }

    public function actif($ID, Request $request){

        $data = $this->Rechercherserviceclient($ID,$request);

        $choix = "";
        if ($data['sc_inactif'] == false) {
            $data['sc_inactif'] = true;
            $choix = "inactif";
        }else if ($data['sc_inactif'] == true) {
            $data['sc_inactif'] = false;
            $choix = "actif";
        }

        $msg = $this->EnregistrementModificationOuSuppression(2,$data,$request);

        return back()->with("message", "Le service à bien été marqué ".$choix);
    }
}
