<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AuthentificationController;

class CoutServiceController extends Controller
{

    public function ListeCoutServiceSelonIDService(Request $request, $IDservice){
        $ser = new ServiceController();
        $service = $ser->RechercherService($IDservice,$request);
        $codeService = $service['sce_code_service'];
        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $loginA = $user['ap_login_pers'];
        $pwdA = $user['ap_pwd_pers'];
        $urlSup = env('APP_URL_SAAS')."coutservice/service/$codeService?login=$loginA&pwd=$pwdA";
        $response = Http::get($urlSup);
        $data = $response->json();
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $IDservice)
    {
        $serv = new ServiceController();
        $service = $serv->RechercherService($IDservice,$request);
        $codeService = $service['sce_code_service'];
        $data = $this->Affectation(1, $request, $codeService); // affectation modif
        $dataStored = $this->EnregistrementModificationOuSuppression(1,$data,$request);
        return $dataStored;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ID, Request $request)
    {
        $coutService = $this->RechercherCoutService($ID,$request);
        return $coutService;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ID, $IDservice)
    {
        $serv = new ServiceController();
        $service = $serv->RechercherService($IDservice,$request);
        $codeService = $service['sce_code_service'];
        $data = $this->Affectation(2, $request, $codeService); // affectation modif
        $dataUpdated = $this->EnregistrementModificationOuSuppression(2,$data,$request);
        return $dataUpdated;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ID, Request $request)
    {
        $data = $this->RechercherCoutService($ID,$request);
        $datadeleted = $this->EnregistrementModificationOuSuppression(3,$data,$request);
        return $datadeleted;
    }

    private function Affectation(int $action, Request $request, $codeService){
        $data = array();
        $idas_cout_service = 0;
        if ($action == 2) {
            $idas_cout_service = Request('idas_cout_service');
        }
        $data = $this->RechercherCoutService($idas_cout_service,$request);
        $data = [
            "idas_cout_service" => $idas_cout_service,
            "cs_code_coutservice" => $data['cs_code_coutservice'],
            "cs_cout_mensuel" => Request('cs_cout_mensuel'),
            "cs_cout_trimestriel" => Request('cs_cout_trimestriel'),
            "cs_cout_semestriel" => Request('cs_cout_semestriel'),
            "cs_cout_annuel" => Request('cs_cout_annuel'),
            "ajoute_le" => $data['ajoute_le'],
            "modifie_le" => $data['modifie_le'],
            "ajoute_par" => $data['ajoute_par'],
            "modifie_par" => $data['modifie_par'],
            "date_heure_sys" => $data['date_heure_sys'],
            "cs_borne_inferieure" => Request('cs_borne_inferieure'),
            "cs_borne_superieure" => Request('cs_borne_superieure'),
            "cs_cout_borne" => Request('cs_cout_borne'),
            "cs_type_service" => Request('cs_type_service'),
            "cs_frequence" => Request('cs_frequence'),
            "cs_intitule" => Request('cs_intitule'),
            "dev_code_devise" => Request('dev_code_devise'),
            "sce_code_service" => $codeService,
        ];
        return $data;
    }

    private function EnregistrementModificationOuSuppression(int $action, array $data, Request $request){
        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $loginA = $user['ap_login_pers'];
        $pwdA = $user['ap_pwd_pers'];
        $idas_cout_service = $data['idas_cout_service'];
        if ($action == 1) { // Enregistrement
            $urlEnr = env('APP_URL_SAAS')."coutservice?login=$loginA&pwd=$pwdA";
            Http::withHeaders([
                'X-Accept' => 'application/json',
            ])->post($urlEnr, $data);
        } else if ($action == 2){ // Modification
            $urlMod = env('APP_URL_SAAS')."coutservice?login=$loginA&pwd=$pwdA";
            Http::put($urlMod, $data);
        }else if ($action == 3) {
            //$urlSup = "api.pierisaas.net/akwabasaas/coutservice/3?login=ADMIN&pwd=ADMIN";
            $urlSup = env('APP_URL_SAAS')."coutservice/$idas_cout_service?login=$loginA&pwd=$pwdA";
            Http::delete($urlSup, $data);
        }
        return $data;
    }

    private function RechercherCoutService($IDcoutservice, Request $request){
        $userAuth = new AuthentificationController();
        $user = $userAuth->RecuperationInfosUserConnecte($request);
        $loginA = $user['ap_login_pers'];
        $pwdA = $user['ap_pwd_pers'];

        $urlSup = env('APP_URL_SAAS')."coutservice/$IDcoutservice?login=$loginA&pwd=$pwdA";
        $response = Http::get($urlSup);
        $data = $response->json();

        return $data;
    }
}
