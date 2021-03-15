<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\AuthentificationController;

class FactureController extends Controller
{
    public function index(Request $request){
        $factures = $this->ListeFacture($request);
        return view('factures.index', compact('factures'));
    }

    public function indexElement(Request $request, $matricule, $element){
        $factures = $this->ListeFacureClientSelonMatriculeClient($request, $matricule);
        return view('factures.facture-user', compact('factures'));
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

    public function store(Request $request, $matricule, $element){
        $this->Validation($request);
        $data = $this->Affectation(1, $request); // affectation enregistrement
        $msg = $this->EnregistrementModificationOuSuppression(1,$data,$request);
        return $data;
    }

    public function edit($ID, Request $request){
        $data = $this->RechercherDevise($ID,$request);
        return $data;
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
        return $data;
    }

    private function Validation(Request $request){
        $request->validate([
            "Fac_montant" => "required",
            "Fac_date_facturation" => "required" ,
            "Fac_date_echeance" => "required" ,
            "Fac_debut_periode" => "required" ,
            "Fac_fin_periode" => "required" ,
        ]);
    }

    private function Affectation(int $action, Request $request, $matricule){

        $data = array();
        $IDas_facture = 0;
        if ($action == 2) {
            $IDas_facture = Request('IDas_facture');
        }
        $data = $this->RechercherFacture($IDas_facture,$request);

        $data = [
            "IDas_facture" => $IDas_facture,
            "Numero_facture" => $data['Numero_facture'],
            "Fac_montant" => Request('Fac_montant'),
            "Fac_montant_paye" => Request('Fac_montant_paye'),
            "Fac_date_facturation" => Request('Fac_date_facturation'),
            "Fac_date_echeance" => Request('Fac_date_echeance'),
            "Fac_debut_periode" => Request('Fac_debut_periode'),
            "Fac_fin_periode" => Request('Fac_fin_periode'),
            "Ajoute_le" => $data['Ajoute_le'],
            "Modifie_le" => $data['Modifie_le'],
            "Ajoute_par" => $data['Ajoute_par'],
            "Modifie_par" => $data['Modifie_par'],
            "Date_heure_sys" => $data['Date_heure_sys'],
            "Ap_matricule_pers" => $matricule,
        ];

        return $data;
    }

    private function EnregistrementModificationOuSuppression(int $action, array $data, Request $request){

        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $loginA = $user['ap_login_pers'];
        $pwdA = $user['ap_pwd_pers'];
        $IDas_facture = $data['IDas_facture'];
        $msg = "";

        /* $datas = json_encode($data);
        dd($datas); */
        if ($action == 1) { // Enregistrement

            $urlEnr = env('APP_URL_SAAS')."facture?login=$loginA&pwd=$pwdA";
            $response = Http::withHeaders([
                'X-Accept' => 'application/json',
            ])->post($urlEnr, $data);
             $msg = "La facture est enregistrée";

        } else if ($action == 2){ // Modification

            $urlMod = env('APP_URL_SAAS')."facture?login=$loginA&pwd=$pwdA";
            $response = Http::put($urlMod, $data);
            $msg = "Facture modifiée";

        }else if ($action == 3) {
            //$urlSup = "api.pierisaas.net/akwabasaas/facture/3?login=ADMIN&pwd=ADMIN";
            $urlSup = env('APP_URL_SAAS')."facture/$IDas_facture?login=$loginA&pwd=$pwdA";
            $response = Http::delete($urlSup, $data);
            $msg = "Facture supprimée";

        }

        return $msg;
    }

    public function regle($ID, Request $request){

        $data = $this->RechercherFacture($ID,$request);

        $choix = "";
        if ($data['Fac_paye'] == false) {
            $data['Fac_paye'] = true;
            $choix = "réglé";
        }else if ($data['Fac_paye'] == true) {
            $data['Fac_paye'] = false;
            $choix = "non réglé";
        }

        $msg = $this->EnregistrementModificationOuSuppression(2,$data,$request);

        return back()->with("message", "La facture à bien été marqué ".$choix);
    }

    private function RechercherFacture($IDfacture, Request $request){
        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $loginA = $user['ap_login_pers'];
        $pwdA = $user['ap_pwd_pers'];

        $urlSup = env('APP_URL_SAAS')."facture/$IDfacture?login=$loginA&pwd=$pwdA";
        $response = Http::get($urlSup);
        $facture = $response->json();

        return $facture;
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
