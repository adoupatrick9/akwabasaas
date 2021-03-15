<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\AuthentificationController;
use phpDocumentor\Reflection\PseudoTypes\False_;

class ClientController extends Controller
{

    public function index(Request $request){
        $userAuth = new AuthentificationController();
        //akwabasaas/utilisateur
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $login = $user['Us_login'];
        $pwd = $user['Us_mot_de_passe'];

        $url = env('APP_URL_SAAS')."client?login=$login&pwd=$pwd";

        $clientHTTP = Http::get($url);
        $clients = $clientHTTP->json();

        return view('clients.index', compact('clients'));

    }

    public function store(Request $request){

        $this->Validation($request);
        $data = $this->Affectation(1, $request); // affectation enregistrement
        $msg = $this->EnregistrementModificationOuSuppression(1,$data,$request);

        if ($msg != "") {
            return redirect('/clients')->with("message", $msg);
        }

    }

    public function edit($ID, Request $request){
        $data = $this->RechercherClient($ID,$request);
        return view('clients.edit', compact('data'));
    }

    public function update(Request $request, $ID){

        $this->Validation($request);
        $data = $this->Affectation(2, $request); // affectation modif
        $msg = $this->EnregistrementModificationOuSuppression(2,$data,$request);

        if ($msg != "") {
            return redirect('/clients')->with("message", $msg);
        }

    }

    public function delete(Request $request, $ID){

        $data = $this->RechercherClient($ID,$request);
        $msg = $this->EnregistrementModificationOuSuppression(3,$data,$request);

        if ($msg != "") {
            return redirect('/clients')->with("message", $msg);
        }

    }

    private function Validation(Request $request){
        $request->validate([
            'cli_acronyme' => 'required',
            'cli_raison_sociale' => 'required',
            'cli_adresse_email' => 'required',
            'cli_pays' => 'required',
            'cli_ville' => 'required',
            'cli_contact_facturation' => 'required',
            'Dev_code' => 'required',
        ]);
    }

    private function Affectation(int $action, Request $request){

        $data = array();
        $IDas_client = 0;
        if ($action == 2) {
            $IDas_client = Request('IDas_client');
        }
        $data = $this->RechercherUtilisateur($IDas_client,$request);

        $cli_acronyme = Request('cli_acronyme');
        $cli_raison_sociale = Request('cli_raison_sociale');
        $cli_adresse_email = Request('cli_adresse_email');
        $cli_adresse_postale = Request('cli_adresse_postale');
        $cli_adresse_geo = Request('cli_adresse_geo');
        $cli_tel = Request('cli_tel');
        $cli_mobile = Request('cli_mobile');
        $cli_pays = Request('cli_pays');
        $cli_ville = Request('cli_ville');
        /* $db_serveur = Request('db_serveur');
        $db_nom = Request('db_nom');
        $db_mdp = Request('db_mdp');
        $db_port = Request('db_port');
        $cli_repertoire = Request('cli_repertoire');
        $cli_adresse_sms = Request('cli_adresse_sms'); */
        $cli_contact_facturation = Request('cli_contact_facturation');
        $cli_partenaire = Request('cli_partenaire');
        $Dev_code = Request('Dev_code');
        $Code_partenaire = Request('Code_partenaire');
        $code_parrain = Request('code_parrain');
        $cli_reference = $data['cli_reference'];
        $ajoute_le = $data['ajoute_le'];
        $modifie_le = $data['modifie_le'];
        $ajoute_par = $data['ajoute_par'];
        $modifie_par = $data['modifie_par'];
        $date_heure_sys = $data['date_heure_sys'];
        $tabas_licence = $data['tabas_licence'];
        $tabas_facture = $data['tabas_facture'];

        $data = array();
        $data = [
            "IDas_client" => $IDas_client,
            "cli_acronyme" => $cli_acronyme,
            "cli_raison_sociale" => $cli_raison_sociale,
            "cli_adresse_email" => $cli_adresse_email,
            "cli_adresse_postale" => $cli_adresse_postale,
            "cli_adresse_geo" => $cli_adresse_geo,
            "cli_tel" => $cli_tel,
            "cli_mobile" => $cli_mobile,
            "cli_pays" => $cli_pays,
            "cli_ville" => $cli_ville,
           /*  "db_serveur" => $db_serveur,
            "db_nom" => $db_nom,
            "db_mdp" => $db_mdp,
            "db_port" => $db_port,
            "cli_repertoire" => $cli_repertoire,
            "cli_adresse_sms" => $cli_adresse_sms, */
            "cli_contact_facturation" => $cli_contact_facturation,
            "cli_partenaire" => $cli_partenaire,
            "ajoute_le" => $ajoute_le,
            "modifie_le" => $modifie_le,
            "ajoute_par" => $ajoute_par,
            "modifie_par" => $modifie_par,
            "code_parrain" => $code_parrain,
            "date_heure_sys" => $date_heure_sys,
            "tabas_licence" => $tabas_licence,
            "tabas_facture" => $tabas_facture,
            "cli_reference" => $cli_reference,
            "Code_partenaire" => $Code_partenaire,
            "Dev_code" => $Dev_code,
        ];

        return $data;
    }

    private function EnregistrementModificationOuSuppression(int $action, array $data, Request $request){

        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $loginA = $user['Us_login'];
        $pwdA = $user['Us_mot_de_passe'];
        $IDas_client = $data['IDas_client'];
        $msg = "";

        //dd($loginA, $pwdA);
        if ($action == 1) { // Enregistrement

            $urlEnr = env('APP_URL_SAAS')."client?login=$loginA&pwd=$pwdA";
            Http::withHeaders([
                'X-Accept' => 'application/json',
            ])->post($urlEnr, $data);
             $msg = "Le client a bien été enregistré.";

        } else if ($action == 2){ // Modification

            $urlMod = env('APP_URL_SAAS')."client?login=$loginA&pwd=$pwdA";
            Http::put($urlMod, $data);
            $msg = "Le client a bien été modifié.";

        }else if ($action == 3) {
            //$urlSup = "api.pierisaas.net/akwabasaas/client/3?login=ADMIN&pwd=ADMIN";
            $urlSup = env('APP_URL_SAAS')."client/$IDas_client?login=$loginA&pwd=$pwdA";
            Http::delete($urlSup, $data);
            $msg = "Le client a bien été supprimé.";

        }

        return $msg;
    }

    private function RechercherClient($IDclient, Request $request){
        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $loginA = $user['Us_login'];
        $pwdA = $user['Us_mot_de_passe'];

        $urlSup = env('APP_URL_SAAS')."client/$IDclient?login=$loginA&pwd=$pwdA";
        $response = Http::get($urlSup);
        $data = $response->json();

        return $data;
    }

    public function actif($ID, Request $request){

        $data = $this->RechercherPartenaire($ID,$request);

        $choix = "";
        if ($data['Cli_inactif'] == false) {
            $data['Cli_inactif'] = true;
            $choix = "inactif";
        }else if ($data['Cli_inactif'] == true) {
            $data['Cli_inactif'] = false;
            $choix = "actif";
        }

        $msg = $this->EnregistrementModificationOuSuppression(2,$data,$request);

        return back()->with("message", "Le client à bien été marqué ".$choix);
    }

}
