<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AuthentificationController;

class UtilisateurController extends Controller
{
    public function index(Request $request, $element){
        $elements = $this->ListeUtilisateurSelonElement($request, $element);
        $pays = $this->ListePays($request);
        $vue = $element."s.index";
        return view($vue, compact('elements', 'pays'));
    }

    public function store(Request $request, $element){
        $avec_login = false;
        if ($element == "utilisateur") {
            $avec_login = true;
        }
        $this->Validation($request, $avec_login);
        $data = $this->Affectation(1, $request, $element); // affectation enregistrement
        $msg = $this->EnregistrementModificationOuSuppression(1,$data,$request, $element);
        return$data;
    }

    public function edit($ID, Request $request, $element){
        $pays = $this->ListePays($request);
        $data = $this->RechercherUtilisateur($ID,$request, $element);
        return$data;
    }

    public function update(Request $request, $ID, $element){
        $avec_login = false;
        if ($element == "utilisateur") {
            $avec_login = true;
        }
        $this->Validation($request, $avec_login);
        $data = $this->Affectation(2, $request, $element); // affectation modif
        $msg = $this->EnregistrementModificationOuSuppression(2,$data,$request, $element);
        return$data;
    }

    public function delete(Request $request, $ID,$element){
        $data = $this->RechercherUtilisateur($ID,$request, $element);
        $msg = $this->EnregistrementModificationOuSuppression(3,$data,$request, $element);
        return$data;
    }

    private function Validation(Request $request, $avec_login = false){
        $login = ""; $type_perse = "'ap_type_pers' => 'required'"; $ville = "'ap_ville_pers' => 'required'"; $pays = "'ap_pays_pers' => 'required'";
        if ($avec_login == true) {
            $login = "'ap_login_pers' => 'required'";
            $type_perse = "";
            $ville = "";
            $pays = "";
        }
        $request->validate([
            $type_perse,
            'ap_nom_pers' => 'required',
            'ap_mobile_pers' => 'required',
            'ap_email_pers' => 'required',
            $ville,
            $pays,
            $login
        ]);
    }

    private function Affectation(int $action, Request $request,$element, $MatriculePartenaire = ""){
        $data = array();
        $idas_personne = 0;

        ($action == 2) ? $idas_personne = Request('idas_personne') : $idas_personne = 0;
        $dataRes = $this->RechercherUtilisateur($idas_personne,$request, $element);

        $ap_genre_pers = "";
        (Request('ap_type_pers') == "1") ? $ap_genre_pers = Request('ap_genre_pers') : $ap_genre_pers = ""  ;

        $data = [
            "idas_personne" => $dataRes['idas_personne'],
            "ap_matricule_pers" => $dataRes['ap_matricule_pers'],
            "ap_type_pers" => Request('ap_type_pers'),
            "ap_nom_pers" => Request('ap_nom_pers'),
            "ap_prenom_pers" => Request('ap_prenom_pers'),
            "ap_telephone_pers" => Request('ap_telephone_pers'),
            "ap_mobile_pers" => Request('ap_mobile_pers'),
            "ap_email_pers" => Request('ap_email_pers'),
            "ap_adressepostale_pers" => Request('ap_adressepostale_pers'),
            "ap_adressegeo_pers" => Request('ap_adressegeo_pers'),
            "ap_login_pers" => Request('ap_login_pers'),
            "ap_pwd_pers" => $dataRes['ap_pwd_pers'],
            "ap_datenais_pers" => Request('ap_datenais_pers'),
            "ap_lieunai_pers" => Request('ap_lieunai_pers'),
            "ap_ville_pers" => Request('ap_ville_pers'),
            "ap_pays_pers" => Request('ap_pays_pers'),
            "ap_genre_pers" => $ap_genre_pers,
            "ap_typepiece_pers" => Request('ap_typepiece_pers'),
            "ap_numeropiece_pers" => Request('ap_numeropiece_pers'),
            "ap_siteweb_pers" => Request('ap_siteweb_pers'),
            "date_heure_sys" => $dataRes['date_heure_sys'],
            "ajoute_le" => $dataRes['ajoute_le'],
            "ajoute_par" => $dataRes['ajoute_par'],
            "modifie_le" => $dataRes['modifie_le'],
            "modifie_par" => $dataRes['modifie_par'],
            "matriculePartenaire" => $MatriculePartenaire,
        ];

        return $data;
    }

    private function EnregistrementModificationOuSuppression(int $action, array $data, Request $request, $element){

        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $loginA = $user['ap_login_pers'];
        $pwdA = $user['ap_pwd_pers'];
        $idas_personne = $data['idas_personne'];
        $msg = "";

        //dd($loginA, $pwdA);
        if ($action == 1) { // Enregistrement

            $urlEnr = env('APP_URL_SAAS')."$element?login=$loginA&pwd=$pwdA";

            $response = Http::withHeaders([
                'X-Accept' => 'application/json',
            ])->post($urlEnr, $data);

             //dd($response);
             $msg = $element." enregistré.";

        } else if ($action == 2){ // Modification

            $urlMod = env('APP_URL_SAAS')."$element?login=$loginA&pwd=$pwdA";
            Http::put($urlMod, $data);
            $msg = $element." modifié.";

        }else if ($action == 3) {
            //$urlSup = "api.pierisaas.net/akwabasaas/$element/3?login=ADMIN&pwd=ADMIN";
            $urlSup = env('APP_URL_SAAS')."$element/$idas_personne?login=$loginA&pwd=$pwdA";
            Http::delete($urlSup, $data);
            $msg = $element." supprimé.";

        }

        return $msg;
    }

    public function RechercherUtilisateur($IDUtilisateur, Request $request, string $element){
        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $loginA = $user['ap_login_pers'];
        $pwdA = $user['ap_pwd_pers'];

        $urlSup = env('APP_URL_SAAS')."$element/$IDUtilisateur?login=$loginA&pwd=$pwdA";
        $response = Http::get($urlSup);
        $data = $response->json();

        return $data;
    }

    public function actif($ID, Request $request, $element){

        $data = $this->RechercherUtilisateur($ID,$request,$element);

        $choix = "";
        if ($data['ap_inactif'] == false) {
            $data['ap_inactif'] = true;
            $choix = "inactif";
        }else if ($data['ap_inactif'] == true) {
            $data['ap_inactif'] = false;
            $choix = "actif";
        }

        $msg = $this->EnregistrementModificationOuSuppression(2,$data,$request,$element);

        $monMsg = $element." marqué ".$choix;

        return back()->with("message", $monMsg);
    }

    public function role($ID, Request $request, $element){

        $data = $this->RechercherUtilisateur($ID,$request,$element);

        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $loginA = $user['ap_login_pers'];
        $pwdA = $user['ap_pwd_pers'];

        $ap_matricule_pers = $data['ap_matricule_pers'];

        $urlSup = env('APP_URL_SAAS')."rolepersonne/$ap_matricule_pers?login=$loginA&pwd=$pwdA";
        $response = Http::get($urlSup);
        $dataNew = $response->json();

        // Affiché les différents rôle dans un tableau
        return $dataNew;
    }

    public function service($ID, Request $request, $element){
        $ServicesClient = $this->RechercherServiceClient($ID,$request,$element);

        $service = new ServiceController();
        $services = $service->ListeServices($request);

        $IDclient = $ID;

        $client = $this->RechercherUtilisateur($IDclient,$request,$element);
        $NomClient = $client['nomComplet'];

        return view('services-client.index', compact('ServicesClient', 'services', 'IDclient', 'NomClient'));
    }

    private function RechercherServiceClient($ID, Request $request, $element){
        $data = $this->RechercherUtilisateur($ID,$request,$element);

        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $loginA = $user['ap_login_pers'];
        $pwdA = $user['ap_pwd_pers'];

        $ap_matricule_pers = $data['ap_matricule_pers'];

        $urlSup = env('APP_URL_SAAS')."serviceclient/client/$ap_matricule_pers?login=$loginA&pwd=$pwdA";
        $response = Http::get($urlSup);

        $ServicesClient = $response->json();
        //dd($ServicesClient);
        // Affiché les différents rôle dans un tableau
        return $ServicesClient;
    }

    public function portefeuille(Request $request, $ID){
        $portefeuilles = $this->RecupererPortefeuillePartenaire($request, $ID);
        $IDpartenaire = $ID;
        $partenaire = $this->RechercherUtilisateur($IDpartenaire,$request,'partenaire');
        $matriculePartenaire = $partenaire['ap_matricule_pers'];
        //dd($matriculePartenaire);
        $nomComplet = $partenaire['nomComplet'];
        $pays = $this->ListePays($request);
        return view('partenaires.portefeuille', compact('portefeuilles', 'nomComplet', 'pays', 'matriculePartenaire', 'IDpartenaire'));
    }

    private function RecupererPortefeuillePartenaire(Request $request, $IDpartenaire){
        $data = $this->RechercherUtilisateur($IDpartenaire,$request,'partenaire');

        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $loginA = $user['ap_login_pers'];
        $pwdA = $user['ap_pwd_pers'];

        $ap_matricule_pers = $data['ap_matricule_pers'];

        $urlSup = env('APP_URL_SAAS')."portefeuille/partenaire/$ap_matricule_pers?login=$loginA&pwd=$pwdA";
        $response = Http::get($urlSup);

        $portefeuilles = $response->json();

        return $portefeuilles;
    }

    private function ListeInterlocuteur($ID, Request $request, $element){
        $data = $this->RechercherUtilisateur($ID,$request,$element);

        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $loginA = $user['ap_login_pers'];
        $pwdA = $user['ap_pwd_pers'];

        $ap_matricule_pers = $data['ap_matricule_pers'];

        $urlSup = env('APP_URL_SAAS')."portefeuille/partenaire/$ap_matricule_pers?login=$loginA&pwd=$pwdA";
        $response = Http::get($urlSup);

        $interlocuteurs = $response->json();

        return $interlocuteurs;
    }

    private function ListeClients(Request $request){
        $userAuth = new AuthentificationController();
        //akwabasaas/utilisateur
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $login = $user['ap_login_pers'];
        $pwd = $user['ap_pwd_pers'];

        $url = env('APP_URL_SAAS')."client?login=$login&pwd=$pwd";

        $clientHTTP = Http::get($url);
        $clients = $clientHTTP->json();

        return $clients;
    }

    public function ListeUtilisateurSelonElement(Request $request, String $element){
        $userAuth = new AuthentificationController();
        //akwabasaas/utilisateur
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $login = $user['ap_login_pers'];
        $pwd = $user['ap_pwd_pers'];

        $url = env('APP_URL_SAAS')."$element?login=$login&pwd=$pwd";

        $elementtHTTP = Http::get($url);
        $elementts = $elementtHTTP->json();

        return $elementts;
    }

    public function portefeuilleCreate($ID, $matricule,  Request $request){
        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $login = $user['ap_login_pers'];
        $pwd = $user['ap_pwd_pers'];
        $this->Validation($request);
        $data = $this->Affectation(1, $request, 'client', $matricule); // affectation
        $urlEnr = env('APP_URL_SAAS')."client?login=$login&pwd=$pwd";
        $response = Http::withHeaders([
            'X-Accept' => 'application/json',
        ])->post($urlEnr, $data);
        return $response->json();
    }

    public function portefeuilleRetirer($ID, Request $request){
        $userAuth = new AuthentificationController();
        //akwabasaas/utilisateur
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $login = $user['ap_login_pers'];
        $pwd = $user['ap_pwd_pers'];

        $Portefeuille = $this->RechercherPortefeuilleSelonID($ID, $request);

        // Indiquer url pour retirer un client du portefeuille
        $urlSup = env('APP_URL_SAAS')."?login=$login&pwd=$pwd";

        Http::delete($urlSup, $Portefeuille);

    }

    public function representant($ID, Request $request, $element){
        $representants = $this->ListeRepresentant($ID,$request,$element);
        $interlocuteurs = $this->ListeInterlocuteursDisponibles($request);
        $IDuser= $ID;
        $user = $this->RechercherUtilisateur($IDuser,$request,$element);
        $nomComplet = $user['nomComplet'];
        return view('utilisateurs.representant', compact('representants', 'nomComplet', 'user', 'interlocuteurs'));
    }

    private function ListeRepresentant($ID, Request $request, $element){
            $data = $this->RechercherUtilisateur($ID,$request,$element);

            $userAuth = new AuthentificationController();
            $user = $userAuth->RecuperationInfosUserConnecte($request);
            $loginA = $user['ap_login_pers'];
            $pwdA = $user['ap_pwd_pers'];

            $ap_matricule_pers = $data['ap_matricule_pers'];

            $urlSup = env('APP_URL_SAAS')."representant/$ap_matricule_pers?login=$loginA&pwd=$pwdA";
            $response = Http::get($urlSup);

            $representants = $response->json();

            return $representants;
    }

    public function marquerInterlocuteurRepresentant($matricule, Request $request){
            Request()->validate([
                'ap_matricule_pers' => 'required',
            ]);

            $userAuth = new AuthentificationController();
            //akwabasaas/utilisateur
            $user = $userAuth->RecuperationInfosUserConnecte($request);
            $login = $user['ap_login_pers'];
            $pwd = $user['ap_pwd_pers'];

            $urlRole = env('APP_URL_SAAS')."rolepersonne/$matricule?login=$login&pwd=$pwd";
            $response = Http::get($urlRole);
            $LesRoles = $response->json();

            $CodeRoleInterlocuteur = "";
            foreach ($LesRoles as $role) {
                if ($role['As_intitulerole'] == "Interlocuteur") {
                    $CodeRoleInterlocuteur = $role['As_intitulerole'];
                }
            }

            $url = env('APP_URL_SAAS')."representant/$matricule/$CodeRoleInterlocuteur?login=$login&pwd=$pwd";
            $interlocuteurHTTP = Http::get($url);
            $interlocuteur = $interlocuteurHTTP->json();

            return $interlocuteur;
    }

    public function ajouterInfoBaseDeDonnee($ID, Request $request, $element){
        Request()->validate([

        ]);
    }

    private function ListeInterlocuteursDisponibles(Request $request){
        $userAuth = new AuthentificationController();
        //akwabasaas/utilisateur
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $login = $user['ap_login_pers'];
        $pwd = $user['ap_pwd_pers'];
        $url = env('APP_URL_SAAS')."interlocuteur?login=$login&pwd=$pwd";
        $interlocuteursHTTP = Http::get($url);
        $interlocuteurs = $interlocuteursHTTP->json();
        return $interlocuteurs;
    }

    private function ListePays(Request $request){
        $userAuth = new AuthentificationController();
        //akwabasaas/utilisateur
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $login = $user['ap_login_pers'];
        $pwd = $user['ap_pwd_pers'];
        $urlPays = env('APP_URL_SAAS')."pays?login=$login&pwd=$pwd";
        $paysHTTP = Http::get($urlPays);
        $pays = $paysHTTP->json();
        return $pays;
    }

    private function RechercherPortefeuilleSelonID($ID, Request $request){
        $userAuth = new AuthentificationController();
        //akwabasaas/utilisateur
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $login = $user['ap_login_pers'];
        $pwd = $user['ap_pwd_pers'];

        $urlSup = env('APP_URL_SAAS')."/portefeuille/$ID?login=$login&pwd=$pwd";
        $response = Http::get($urlSup);

        $Portefeuille = $response->json();

        return $Portefeuille;
    }

}
