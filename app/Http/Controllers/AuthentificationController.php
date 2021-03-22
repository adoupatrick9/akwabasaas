<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthentificationController extends Controller
{
    public function PageLogin(){
        return view('auth.login');
    }

    public function Connexion(Request $request){
        $request->validate([
            'login' => 'required|max:255',
            'pwd' => 'required',
        ]);

        $login = $request->input('login');
        $pwd = $request->input('pwd');

        $url = env("APP_URL_SAAS")."connexion/$login/$pwd";

        $userHTTP = Http::get($url);
        //dd($userHTTP);
        $user = $userHTTP->json();
        if ($user['ap_matricule_pers'] == "") {
            return back()->with("message", "Les données ne correspondent pas !!!");
        } else {
            $request->session()->put('user', $user); // création de la session avec clé user
            return view('index', compact('user'));
        }
    }

    public function RecuperationInfosUserConnecte(Request $request){
        $user = $request->session()->get('user');
        return $user;
    }

    public function VerificationAuthentification(Request $request){
        $ok = false;
        if ($request->session()->get('user')) {
            $user = $request->session()->get('user');
            if ($user['ap_login_pers'] != "") {
                $ok = true;
            }
        }
        return $ok;
    }

    public function Deconnexion(Request $request){
        // Forget a single key...
        $request->session()->forget('user');
        return view('auth.login');
    }

    public function RecupererRolesUtilisateurConnecter(Request $request){

        $user = $this->RecuperationInfosUserConnecte($request);
        $loginA = $user['ap_login_pers'];
        $pwdA = $user['ap_pwd_pers'];
        $ap_matricule_pers = $user['ap_matricule_pers'];

        $urlSup = env('APP_URL_SAAS')."rolepersonne/$ap_matricule_pers?login=$loginA&pwd=$pwdA";
        $response = Http::get($urlSup);
        $data = $response->json();

        return $data;
    }

    public function VerificationPartenaire(Request $request){
        $ok = false;
        $roles = $this->RecupererRolesUtilisateurConnecter($request);
        foreach ($roles as $role) {
            //dd($role);
            ($role['As_intitulerole'] == "Partenaire") ? $ok = true : $ok = false;
        }
        return $ok;
    }
}
