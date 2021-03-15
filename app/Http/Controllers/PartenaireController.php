<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\AuthentificationController;

class PartenaireController extends Controller
{
    public function index(Request $request){
        $userAuth = new AuthentificationController();
        //akwabasaas/utilisateur
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $login = $user['Us_login'];
        $pwd = $user['Us_mot_de_passe'];

        $url = env('APP_URL_SAAS')."utilisateur?login=$login&pwd=$pwd";

        $partenaireHTTP = Http::get($url);
        $partenaires = $partenaireHTTP->json();

        return view('partenaires.index', compact('partenaires'));

    }

    public function store(Request $request){

        $this->Validation($request);
        $data = $this->Affectation(1, $request); // affectation enregistrement
        $msg = $this->EnregistrementModificationOuSuppression(1,$data,$request);

        if ($msg != "") {
            return redirect('/partenaires')->with("message", $msg);
        }

    }

    public function edit($ID, Request $request){
        $data = $this->RechercherPartenaire($ID,$request);
        return view('partenaires.edit', compact('data'));
    }

    public function update(Request $request, $ID){

        $this->Validation($request);
        $data = $this->Affectation(2, $request); // affectation modif
        $msg = $this->EnregistrementModificationOuSuppression(2,$data,$request);

        if ($msg != "") {
            return redirect('/partenaires')->with("message", $msg);
        }

    }

    public function delete(Request $request, $ID){

        $data = $this->RechercherPartenaire($ID,$request);
        $msg = $this->EnregistrementModificationOuSuppression(3,$data,$request);

        if ($msg != "") {
            return redirect('/partenaires')->with("message", $msg);
        }

    }

    private function Validation(Request $request){
        $request->validate([
            "Pt_nom" => 'required',
            "Pt_type" => 'required',
            "Pt_mobile" => 'required',
            "Pt_adresse_email" => 'required',
            "Pt_pays" => 'required',
            "Pt_ville" => 'required',
            "Pt_date_partenariat"	=> 'required',
        ]);
    }

    private function Affectation(int $action, Request $request){

        $data = array();
        $IDas_partenaire = 0;
        if ($action == 2) {
            $IDas_partenaire = Request('IDas_partenaire');
        }

        $data = $this->RechercherPartenaire($IDas_partenaire,$request);

        //dd($request->input());
        $Pt_nom = Request('Pt_nom');
        $Pt_type = Request('Pt_type');
        $Pt_tel = Request('Pt_tel');
        $Pt_mobile = Request('Pt_mobile');
        $Pt_adresse_email = Request('Pt_adresse_email');
        $Pt_adresse_postale = Request('Pt_adresse_postale');
        $Pt_adresse_geo = Request('Pt_adresse_geo');
        $Pt_pays = Request('Pt_pays');
        $Pt_ville = Request('Pt_ville');
        $Pt_numero_immatriculation = Request('Pt_numero_immatriculation');
        $Pt_site_web = Request('db_port');
        $Pt_date_partenariat = Request('Pt_date_partenariat');
        $Pt_taux_remise = Request('Pt_taux_remise');
        $Pt_taux_interessement = Request('Pt_taux_interessement');
        $Code_partenaire = $data['Code_partenaire'];
        $Pt_inactif = $data['Pt_inactif'];
        $Ajoute_le = $data['Ajoute_le'];
        $Modifie_le = $data['Modifie_le'];
        $Ajoute_par = $data['Ajoute_par'];
        $Modifie_par = $data['Modifie_par'];
        $Date_heure_sys = $data['Date_heure_sys'];

        $data = [
            "IDas_partenaire" => $IDas_partenaire,
            "Code_partenaire" => $Code_partenaire,
            "Pt_nom" => $Pt_nom,
            "Pt_type" => $Pt_type,
            "Pt_tel" => $Pt_tel,
            "Pt_mobile" => $Pt_mobile,
            "Pt_adresse_email" => $Pt_adresse_email,
            "Pt_adresse_postale" => $Pt_adresse_postale,
            "Pt_adresse_geo" => $Pt_adresse_geo,
            "Pt_pays" => $Pt_pays,
            "Pt_ville" => $Pt_ville,
            "Pt_numero_immatriculation" => $Pt_numero_immatriculation,
            "Pt_site_web" => $Pt_site_web,
            "Pt_date_partenariat" => $Pt_date_partenariat,
            "Pt_taux_remise" => $Pt_taux_remise,
            "Pt_taux_interessement" => $Pt_taux_interessement,
            "Pt_inactif" => $Pt_inactif,
            "Ajoute_le" => $Ajoute_le,
            "Modifie_le" => $Modifie_le,
            "Ajoute_par" => $Ajoute_par,
            "Modifie_par" => $Modifie_par,
            "Date_heure_sys" => $Date_heure_sys,
        ];

        return $data;
    }

    private function EnregistrementModificationOuSuppression(int $action, array $data, Request $request){

        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $loginA = $user['Us_login'];
        $pwdA = $user['Us_mot_de_passe'];
        $IDas_partenaire = $data['IDas_partenaire'];
        $msg = "";

        //dd($loginA, $pwdA);
        if ($action == 1) { // Enregistrement

            $urlEnr = env('APP_URL_SAAS')."partenaire?login=$loginA&pwd=$pwdA";
            Http::withHeaders([
                'X-Accept' => 'application/json',
            ])->post($urlEnr, $data);
             $msg = "Le partenaire a bien été enregistré.";

        } else if ($action == 2){ // Modification

            $urlMod = env('APP_URL_SAAS')."partenaire?login=$loginA&pwd=$pwdA";
            Http::put($urlMod, $data);
            $msg = "Le partenaire a bien été modifié.";

        }else if ($action == 3) {
            //$urlSup = "api.pierisaas.net/akwabasaas/partenaire/3?login=ADMIN&pwd=ADMIN";
            $urlSup = env('APP_URL_SAAS')."partenaire/$IDas_partenaire?login=$loginA&pwd=$pwdA";
            Http::delete($urlSup, $data);
            $msg = "Le partenaire a bien été supprimé.";

        }

        return $msg;
    }

    private function RechercherPartenaire($IDpartenaire, Request $request){
        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $loginA = $user['Us_login'];
        $pwdA = $user['Us_mot_de_passe'];

        $urlSup = env('APP_URL_SAAS')."partenaire/$IDpartenaire?login=$loginA&pwd=$pwdA";
        $response = Http::get($urlSup);
        $data = $response->json();

        return $data;
    }

    public function actif($ID, Request $request){

        $data = $this->RechercherPartenaire($ID,$request);

        $choix = "";
        if ($data['Pt_inactif'] == false) {
            $data['Pt_inactif'] = true;
            $choix = "inactif";
        }else if ($data['Pt_inactif'] == true) {
            $data['Pt_inactif'] = false;
            $choix = "actif";
        }

        $msg = $this->EnregistrementModificationOuSuppression(2,$data,$request);

        return back()->with("message", "Le partenaire à bien été marqué ".$choix);
    }
}
