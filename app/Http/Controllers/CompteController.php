<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\AuthentificationController;

class CompteController extends Controller
{
    public function index(Request $request){
        $userAuth = new AuthentificationController();
        //akwabasaas/utilisateur
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $login = $user['Us_login'];
        $pwd = $user['Us_mot_de_passe'];

        $url = env('APP_URL_SAAS')."compte?login=$login&pwd=$pwd";

        $compteHTTP = Http::get($url);
        $comptes = $compteHTTP->json();

        return view('comptes.index', compact('comptes'));

    }

    public function store(Request $request){

        $this->Validation($request);
        $data = $this->Affectation(1, $request); // affectation enregistrement
        $msg = $this->EnregistrementModificationOuSuppression(1,$data,$request);

        if ($msg != "") {
            return redirect('/comptes')->with("message", $msg);
        }

    }

    public function edit($ID, Request $request){
        $data = $this->Recherchercompte($ID,$request);
        return view('comptes.edit', compact('data'));
    }

    public function update(Request $request, $ID){

        $this->Validation($request);
        $data = $this->Affectation(2, $request); // affectation modif
        $msg = $this->EnregistrementModificationOuSuppression(2,$data,$request);

        if ($msg != "") {
            return redirect('/comptes')->with("message", $msg);
        }

    }

    public function delete(Request $request, $ID){

        $data = $this->Recherchercompte($ID,$request);
        $msg = $this->EnregistrementModificationOuSuppression(3,$data,$request);

        if ($msg != "") {
            return redirect('/comptes')->with("message", $msg);
        }

    }

    private function Validation(Request $request){
        $request->validate([
            "Cpt_solde" => 'required',
            "Ref_tiers" => 'required',
        ]);
    }

    private function Affectation(int $action, Request $request){
        $data = array();
        $IDas_compte = 0;
        $Cpt_inactif = false;
        if ($action == 2) {
            $IDas_compte = Request('IDas_compte');
            $data = $this->Recherchercompte($IDas_compte,$request);
            $Cpt_inactif = Request('Cpt_inactif');
        }

        $Cpt_solde = Request('Cpt_solde');
        $Ref_tiers = Request('Ref_tiers');
        $Numero_compte = $data['Numero_compte'];
        $ajoute_le = $data['ajoute_le'];
        $modifie_le = $data['modifie_le'];
        $ajoute_par = $data['ajoute_par'];
        $modifie_par = $data['modifie_par'];
        $date_heure_sys = $data['date_heure_sys'];

        $data = array();
        $data = [
            "IDas_compte" => $IDas_compte,
            "Numero_compte" => $Numero_compte,
            "Cpt_solde" => $Cpt_solde,
            "Cpt_inactif" => $Cpt_inactif,
            "Ajoute_le" => $ajoute_le,
            "Modifie_le" => $modifie_le,
            "Ajoute_par" => $ajoute_par,
            "Modifie_par" => $modifie_par,
            "Date_heure_sys" => $date_heure_sys,
            "Ref_tiers" => $Ref_tiers,
        ];

        return $data;
    }

    private function EnregistrementModificationOuSuppression(int $action, array $data, Request $request){

        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $loginA = $user['Us_login'];
        $pwdA = $user['Us_mot_de_passe'];
        $IDas_compte = $data['IDas_compte'];
        $msg = "";

        //dd($loginA, $pwdA);
        if ($action == 1) { // Enregistrement

            $urlEnr = env('APP_URL_SAAS')."compte?login=$loginA&pwd=$pwdA";
            Http::withHeaders([
                'X-Accept' => 'application/json',
            ])->post($urlEnr, $data);
             $msg = "Le compte a bien été enregistré.";

        } else if ($action == 2){ // Modification

            $urlMod = env('APP_URL_SAAS')."compte?login=$loginA&pwd=$pwdA";
            Http::put($urlMod, $data);
            $msg = "Le compte a bien été modifié.";

        }else if ($action == 3) {
            //$urlSup = "api.pierisaas.net/akwabasaas/compte/3?login=ADMIN&pwd=ADMIN";
            $urlSup = env('APP_URL_SAAS')."compte/$IDas_compte?login=$loginA&pwd=$pwdA";
            Http::delete($urlSup, $data);
            $msg = "Le compte a bien été supprimé.";

        }

        return $msg;
    }

    private function Recherchercompte($IDcompte, Request $request){
        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $loginA = $user['Us_login'];
        $pwdA = $user['Us_mot_de_passe'];

        $urlSup = env('APP_URL_SAAS')."compte/$IDcompte?login=$loginA&pwd=$pwdA";
        $response = Http::get($urlSup);
        $data = $response->json();

        return $data;
    }
}
