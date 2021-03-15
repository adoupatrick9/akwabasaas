<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\AuthentificationController;

class InterlocuteurController extends Controller
{
    public function index(Request $request){
        $userAuth = new AuthentificationController();
        //akwabasaas/interlocuteur
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $login = $user['Us_login'];
        $pwd = $user['Us_mot_de_passe'];

        $url = env('APP_URL_SAAS')."interlocuteur?login=$login&pwd=$pwd";

        $userHTTP = Http::get($url);
        $users = $userHTTP->json();

        return view('interlocuteurs.index', compact('users'));
    }

    public function store(Request $request){

        $this->Validation($request);
        $data = $this->Affectation(1, $request); // affectation enregistrement
        $msg = $this->EnregistrementModificationOuSuppression(1,$data,$request);

        if ($msg != "") {
            return redirect('/interlocuteurs')->with("message", $msg);
        }

    }

    public function edit($ID, Request $request){
        $data = $this->RechercherInterlocuteur($ID,$request);
        return view('interlocuteurs.edit', compact('data'));
    }

    public function update(Request $request, $ID){

        $this->Validation($request);
        $data = $this->Affectation(2, $request); // affectation modif
        $msg = $this->EnregistrementModificationOuSuppression(2,$data,$request);

        if ($msg != "") {
            return redirect('/interlocuteurs')->with("message", $msg);
        }

    }

    public function delete(Request $request, $ID){

        $data = $this->RechercherInterlocuteur($ID,$request);
        $msg = $this->EnregistrementModificationOuSuppression(3,$data,$request);

        if ($msg != "") {
            return redirect('/interlocuteurs')->with("message", $msg);
        }

    }

    private function Validation(Request $request){
        $request->validate([
            'Int_nom' => 'required',
            'Int_prenom' => 'required',
            'Int_mobile' => 'required',
            'Int_reftiers' => 'required',
        ]);
    }

    private function Affectation(int $action, Request $request){

        $id = 0;
        $Int_inactif = false;
        if ($action == 2) {
            $id = Request('id');
            $data = $this->RechercherInterlocuteur($id,$request);
            $Int_inactif = Request('Int_inactif');
        }

        $Int_nom = Request('Int_nom');
        $Int_prenom = Request('Int_prenom');
        $Int_tel = Request('Int_tel');
        $Int_mobile = Request('Int_mobile');
        $Int_adresse_email = Request('Int_adresse_email');
        $Int_adresse_postale = Request('Int_adresse_postale');
        $Int_adresse_geo = Request('Int_adresse_geo');
        $Int_fonction = Request('Int_fonction');
        $Int_reftiers = Request('Int_reftiers');
        $IDas_interlocuteur = $data['IDas_interlocuteur'];
        $Code_interlocuteur = $data['Code_interlocuteur'];
        $ajoute_le = $data['ajoute_le'];
        $modifie_le = $data['modifie_le'];
        $ajoute_par = $data['ajoute_par'];
        $modifie_par = $data['modifie_par'];
        $date_heure_sys = $data['date_heure_sys'];

        $data = array();
        $data = [
            "IDas_interlocuteur" => $IDas_interlocuteur,
            "Code_interlocuteur" => $Code_interlocuteur,
            "Int_nom" => $Int_nom,
            "Int_prenom" => $Int_prenom,
            "Int_tel" => $Int_tel,
            "Int_mobile" => $Int_mobile,
            "Int_adresse_email" => $Int_adresse_email,
            "Int_adresse_postale" => $Int_adresse_postale,
            "Int_adresse_geo" => $Int_adresse_geo,
            "Int_fonction" => $Int_fonction,
            "Int_inactif" => $Int_inactif,
            "Ajoute_le"	=> $ajoute_le,
            "Modifie_le"	=> $modifie_le,
            "Ajoute_par" => $ajoute_par,
            "Modifie_par" => $modifie_par,
            "Date_heure_sys" => $date_heure_sys,
            "Int_reftiers" => $Int_reftiers,
        ];

        return $data;
    }

    private function EnregistrementModificationOuSuppression(int $action, array $data, Request $request){

        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $loginA = $user['Us_login'];
        $pwdA = $user['Us_mot_de_passe'];
        $IDinterlocuteur = $data['IDas_interlocuteur'];
        $msg = "";

        //dd($loginA, $pwdA);
        if ($action == 1) { // Enregistrement

            $urlEnr = env('APP_URL_SAAS')."interlocuteur?login=$loginA&pwd=$pwdA";
            Http::withHeaders([
                'X-Accept' => 'application/json',
            ])->post($urlEnr, $data);
             $msg = "L'interlocuteur a bien été enregistré.";

        } else if ($action == 2){ // Modification

            $urlMod = env('APP_URL_SAAS')."interlocuteur?login=$loginA&pwd=$pwdA";
            Http::put($urlMod, $data);
            $msg = "L'interlocuteur a bien été modifié.";

        }else if ($action == 3) {
            //$urlSup = "api.pierisaas.net/akwabasaas/interlocuteur/3?login=ADMIN&pwd=ADMIN";
            $urlSup = env('APP_URL_SAAS')."interlocuteur/$IDinterlocuteur?login=$loginA&pwd=$pwdA";
            Http::delete($urlSup, $data);
            $msg = "L'interlocuteur a bien été supprimé.";

        }

        return $msg;
    }

    private function RechercherInterlocuteur($IDinterlocuteur, Request $request){
        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $loginA = $user['Us_login'];
        $pwdA = $user['Us_mot_de_passe'];

        $urlSup = env('APP_URL_SAAS')."interlocuteur/$IDinterlocuteur?login=$loginA&pwd=$pwdA";
        $response = Http::get($urlSup);
        $data = $response->json();

        return $data;
    }
}
