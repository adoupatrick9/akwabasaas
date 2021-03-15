<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\AuthentificationController;

class LicenceController extends Controller
{
    public function index(Request $request){
        $userAuth = new AuthentificationController();
        //akwabasaas/utilisateur
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $login = $user['Us_login'];
        $pwd = $user['Us_mot_de_passe'];

        $url = env('APP_URL_SAAS')."licence?login=$login&pwd=$pwd";

        $licenceHTTP = Http::get($url);
        $licences = $licenceHTTP->json();

        return view('licences.index', compact('licences'));

    }

    public function store(Request $request){

        $this->Validation($request);
        $data = $this->Affectation(1, $request); // affectation enregistrement
        $msg = $this->EnregistrementModificationOuSuppression(1,$data,$request);

        if ($msg != "") {
            return redirect('/licences')->with("message", $msg);
        }

    }

    public function edit($ID, Request $request){
        $data = $this->RechercherLicence($ID,$request);
        return view('licences.edit', compact('data'));
    }

    public function update(Request $request, $ID){

        $this->Validation($request);
        $data = $this->Affectation(2, $request); // affectation modif
        $msg = $this->EnregistrementModificationOuSuppression(2,$data,$request);

        if ($msg != "") {
            return redirect('/licences')->with("message", $msg);
        }

    }

    public function delete(Request $request, $ID){

        $data = $this->RechercherLicence($ID,$request);
        $msg = $this->EnregistrementModificationOuSuppression(3,$data,$request);

        if ($msg != "") {
            return redirect('/licences')->with("message", $msg);
        }

    }

    private function Validation(Request $request){
        $request->validate([
            "Lic_cle_physique" => 'required',
            "Lic_nombre_salarie" => 'required',
            "Lic_cle_licence" => 'required',
            "Cli_reference" => 'required',
            "Sce_code" => 'required',
        ]);
    }

    private function Affectation(int $action, Request $request){
        $data = array();
        $IDas_licence = 0;
        if ($action == 2) {
            $IDas_licence = Request('IDas_licence');
            $data = $this->RechercherLicence($IDas_licence,$request);
        }

        $Lic_cle_physique = Request('Lic_cle_physique');
        $Lic_nombre_salarie = Request('Lic_nombre_salarie');
        $Lic_cle_licence = Request('Lic_cle_licence');
        $Lic_montant_remise = Request('Lic_montant_remise');
        $Code_partenaire = Request('Code_partenaire');
        $Cli_reference = Request('Cli_reference');
        $Sce_code = Request('Sce_code');
        $Code_licence = $data['Code_licence'];
        $Sce_nom = $data['Sce_nom'];
        $Cli_acronyme = $data['Cli_acronyme'];
        $Cli_raison_sociale = $data['Cli_raison_sociale'];
        $Cli_adresse_email = $data['Cli_adresse_email'];
        $Cli_mobile = $data['Cli_mobile'];
        $ajoute_le = $data['ajoute_le'];
        $modifie_le = $data['modifie_le'];
        $ajoute_par = $data['ajoute_par'];
        $modifie_par = $data['modifie_par'];
        $date_heure_sys = $data['date_heure_sys'];

        $data = array();
        $data = [
            "IDas_licence" => $IDas_licence,
            "Code_licence" => $Code_licence,
            "Lic_cle_physique" => $Lic_cle_physique,
            "Lic_nombre_salarie" => $Lic_nombre_salarie,
            "Lic_cle_licence" => $Lic_cle_licence,
            "Lic_montant_remise" => $Lic_montant_remise,
            "Code_partenaire" => $Code_partenaire,
            "Cli_reference" => $Cli_reference,
            "Sce_code" => $Sce_code,
            "ajoute_le" => $ajoute_le,
            "modifie_le" => $modifie_le,
            "ajoute_par" => $ajoute_par,
            "modifie_par" => $modifie_par,
            "date_heure_sys" => $date_heure_sys,
            "Sce_nom" => $Sce_nom,
            "Cli_acronyme" => $Cli_acronyme,
            "Cli_raison_sociale" => $Cli_raison_sociale,
            "Cli_adresse_email" => $Cli_adresse_email,
            "Cli_mobile" => $Cli_mobile,
        ];

        return $data;
    }

    private function EnregistrementModificationOuSuppression(int $action, array $data, Request $request){

        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $loginA = $user['Us_login'];
        $pwdA = $user['Us_mot_de_passe'];
        $IDas_licence = $data['IDas_licence'];
        $msg = "";

        //dd($loginA, $pwdA);
        if ($action == 1) { // Enregistrement

            $urlEnr = env('APP_URL_SAAS')."licence?login=$loginA&pwd=$pwdA";
            Http::withHeaders([
                'X-Accept' => 'application/json',
            ])->post($urlEnr, $data);
             $msg = "La licence a bien été enregistré.";

        } else if ($action == 2){ // Modification

            $urlMod = env('APP_URL_SAAS')."licence?login=$loginA&pwd=$pwdA";
            Http::put($urlMod, $data);
            $msg = "La licence a bien été modifié.";

        }else if ($action == 3) {
            //$urlSup = "api.pierisaas.net/akwabasaas/licence/3?login=ADMIN&pwd=ADMIN";
            $urlSup = env('APP_URL_SAAS')."licence/$IDas_licence?login=$loginA&pwd=$pwdA";
            Http::delete($urlSup, $data);
            $msg = "La licence a bien été supprimé.";

        }

        return $msg;
    }

    private function RechercherLicence($IDlicence, Request $request){
        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $loginA = $user['Us_login'];
        $pwdA = $user['Us_mot_de_passe'];

        $urlSup = env('APP_URL_SAAS')."licence/$IDlicence?login=$loginA&pwd=$pwdA";
        $response = Http::get($urlSup);
        $data = $response->json();

        return $data;
    }
}
