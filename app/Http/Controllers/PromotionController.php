<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\AuthentificationController;

class PromotionController extends Controller
{
    public function index(Request $request){
        $userAuth = new AuthentificationController();
        //akwabasaas/utilisateur
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $login = $user['ap_login_pers'];
        $pwd = $user['ap_pwd_pers'];

        $url = env('APP_URL_SAAS')."promotion?login=$login&pwd=$pwd";
        $urlS = env('APP_URL_SAAS')."service?login=$login&pwd=$pwd";
        $urlD = env('APP_URL_SAAS')."devise?login=$login&pwd=$pwd";

        $promotionHTTP = Http::get($url);
        $promotions = $promotionHTTP->json();

        //dd($promotions);

        $serviceHTTP = Http::get($urlS);
        $services = $serviceHTTP->json();

        $deviseHTTP = Http::get($urlD);
        $devises = $deviseHTTP->json();

        return view('promotions.index', compact('promotions', 'services', 'devises'));

    }

    public function store(Request $request){

        $this->Validation($request);
        $data = $this->Affectation(1, $request); // affectation enregistrement
        $msg = $this->EnregistrementModificationOuSuppression(1,$data,$request);

        if ($msg != "") {
            return redirect('/promotions')->with("message", $msg);
        }

    }

    public function edit($ID, Request $request){
        $userAuth = new AuthentificationController();
        //akwabasaas/utilisateur
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $login = $user['ap_login_pers'];
        $pwd = $user['ap_pwd_pers'];
        $urlS = env('APP_URL_SAAS')."service?login=$login&pwd=$pwd";
        $urlD = env('APP_URL_SAAS')."devise?login=$login&pwd=$pwd";

        $data = $this->RechercherPromotion($ID,$request);

        $serviceHTTP = Http::get($urlS);
        $services = $serviceHTTP->json();

        $deviseHTTP = Http::get($urlD);
        $devises = $deviseHTTP->json();

        return view('promotions.edit', compact('data', 'services', 'devises'));
    }

    public function update(Request $request, $ID){

        $this->Validation($request);
        $data = $this->Affectation(2, $request); // affectation modif
        $msg = $this->EnregistrementModificationOuSuppression(2,$data,$request);

        if ($msg != "") {
            return redirect('/promotions')->with("message", $msg);
        }

    }

    public function delete(Request $request, $ID){

        $data = $this->RechercherPromotion($ID,$request);
        $msg = $this->EnregistrementModificationOuSuppression(3,$data,$request);

        if ($msg != "") {
            return redirect('/promotions')->with("message", $msg);
        }

    }

    private function Validation(Request $request){
        $request->validate([
            "pro_intitule" => 'required',
            "pro_cout_unitaire" => 'required',
            "pro_debut_periode" => 'required',
            "pro_fin_periode" => 'required',
            "Sce_code_service" => 'required',
            "Dev_code_devise" => 'required',
            "pro_cout_mensuel" => 'required',
            "pro_cout_trimestriel" => 'required',
            "pro_cout_semestriel" => 'required',
            "pro_cout_annuel" => 'required',
        ]);
    }

    private function Affectation(int $action, Request $request){


        $data = array();
        $IDas_promotion = 0;
        if ($action == 2) {
            $IDas_promotion = Request('IDas_promotion');
        }

        $data = $this->RechercherPromotion($IDas_promotion,$request);

        $pro_intitule = Request('pro_intitule');
        $pro_cout_unitaire = Request('pro_cout_unitaire');
        $pro_debut_periode = Request('pro_debut_periode');
        $pro_fin_periode = Request('pro_fin_periode');
        $Sce_code_service = Request('Sce_code_service');
        $Dev_code_devise = Request('Dev_code_devise');
        $pro_cout_mensuel = Request('pro_cout_mensuel');
        $pro_cout_trimestriel = Request('pro_cout_trimestriel');
        $pro_cout_semestriel = Request('pro_cout_semestriel');
        $pro_cout_annuel = Request('pro_cout_annuel');
        $pro_code_promo    =   $data['pro_code_promo'];
        $ajoute_le = $data['ajoute_le'];
        $modifie_le = $data['modifie_le'];
        $ajoute_par = $data['ajoute_par'];
        $modifie_par = $data['modifie_par'];
        $date_heure_sys = $data['date_heure_sys'];

        $data = [
            "IDas_promotion" => $IDas_promotion,
            "pro_code_promo" => $pro_code_promo,
            "pro_intitule" => $pro_intitule,
            "pro_debut_periode" => $pro_debut_periode,
            "pro_fin_periode" => $pro_fin_periode,
            "ajoute_le" => $ajoute_le,
            "modifie_le" => $modifie_le,
            "ajoute_par" => $ajoute_par,
            "modifie_par" => $modifie_par,
            "date_heure_sys" => $date_heure_sys,
            "pro_cout_mensuel" => $pro_cout_mensuel,
            "pro_cout_trimestriel" => $pro_cout_trimestriel,
            "pro_cout_semestriel" => $pro_cout_semestriel,
            "pro_cout_annuel" => $pro_cout_annuel,
            "pro_cout_unitaire" => $pro_cout_unitaire,
            "Sce_code_service" => $Sce_code_service,
            "Dev_code_devise" => $Dev_code_devise,

        ];

        return $data;
    }

    private function EnregistrementModificationOuSuppression(int $action, array $data, Request $request){

        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $loginA = $user['ap_login_pers'];
        $pwdA = $user['ap_pwd_pers'];
        $IDas_promotion = $data['IDas_promotion'];
        $msg = "";

        //dd($loginA, $pwdA);
        if ($action == 1) { // Enregistrement

            $urlEnr = env('APP_URL_SAAS')."promotion?login=$loginA&pwd=$pwdA";
            Http::withHeaders([
                'X-Accept' => 'application/json',
            ])->post($urlEnr, $data);
             $msg = "La promotion a bien été enregistré.";

        } else if ($action == 2){ // Modification

            $urlMod = env('APP_URL_SAAS')."promotion?login=$loginA&pwd=$pwdA";
            Http::put($urlMod, $data);
            $msg = "La promotion a bien été modifié.";

        }else if ($action == 3) {
            //$urlSup = "api.pierisaas.net/akwabasaas/promotion/3?login=ADMIN&pwd=ADMIN";
            $urlSup = env('APP_URL_SAAS')."promotion/$IDas_promotion?login=$loginA&pwd=$pwdA";
            Http::delete($urlSup, $data);
            $msg = "La promotion a bien été supprimé.";

        }

        return $msg;
    }

    private function RechercherPromotion($IDpromotion, Request $request){
        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $loginA = $user['ap_login_pers'];
        $pwdA = $user['ap_pwd_pers'];

        $urlSup = env('APP_URL_SAAS')."promotion/$IDpromotion?login=$loginA&pwd=$pwdA";
        $response = Http::get($urlSup);
        $data = $response->json();

        return $data;
    }

    public function actif($ID, Request $request){

        $data = $this->RechercherPromotion($ID,$request);

        $choix = "";
        if ($data['pro_inactif'] == false) {
            $data['pro_inactif'] = true;
            $choix = "inactif";
        }else if ($data['pro_inactif'] == true) {
            $data['pro_inactif'] = false;
            $choix = "actif";
        }

        $msg = $this->EnregistrementModificationOuSuppression(2,$data,$request);

        return back()->with("message", "La promotion à bien été marqué ".$choix);

    }
}
