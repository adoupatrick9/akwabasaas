<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Client;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Permet d'extraire le fichier ZIP
/* Route::get('/extraire', function () {
    $zip = new ZipArchive;
     $res = $zip->open('saas.akwaba.pro\Akwabasaas.zip');
     if ($res === TRUE) {
         $zip->extractTo('saas.akwaba.pro');
         $zip->close();
         return 'extraction terminée';
     } else {
         return 'extraction impossible';
     }
}); */
//---------------------------------------

//page d'accueil
Route::redirect('https://saas.akwaba.pro/public/index.php/', '/login');
Route::redirect('/', '/login', 301);

Route::get('/login', 'AuthentificationController@PageLogin');
Route::post('/login', 'AuthentificationController@Connexion');

// Liste des routes ayant besoin d'être authentifié avant d'y accéder
Route::middleware(['verif'])->group(function () {
    Route::get('/deconnexion', 'AuthentificationController@Deconnexion');

    // Accueil lorsque auth = ok
    Route::get('/index', 'IndexController@index');

     //gestion des configurations
    Route::get('/configurations', 'ConfigurationController@index');

    //gestion des devises
    Route::post('/devises-create', 'DeviseController@store');
    Route::get('/devises-edit/{ID}/configurations', 'DeviseController@edit');
    Route::post('/devises-update/{ID}', 'DeviseController@update');
    Route::get('/devises-delete/{ID}', 'DeviseController@delete');

    //gestion des personnes
    Route::get('/utilisateurs/{element}', 'UtilisateurController@index');
    Route::post('/utilisateurs-create/{element}', 'UtilisateurController@store');
    Route::get('/utilisateurs-edit/{ID}/{element}', 'UtilisateurController@edit');
    Route::post('/utilisateurs-update/{ID}/{element}', 'UtilisateurController@update');
    Route::get('/utilisateurs-delete/{ID}/{element}', 'UtilisateurController@delete');
    Route::get('/utilisateurs-actif-inactif/{ID}/{element}', 'UtilisateurController@actif');
    Route::get('/utilisateurs-role/{ID}/{element}', 'UtilisateurController@role');
    Route::get('/utilisateurs-base-de-donnee/{ID}/{element}', 'UtilisateurController@ajouterInfoBaseDeDonnee');
    Route::get('/utilisateurs-portefeuille/{ID}/{element}', 'UtilisateurController@portefeuille');
    Route::post('/utilisateurs-portefeuille-create/{ID}/{matricule}', 'UtilisateurController@portefeuilleCreate');
    Route::get('/utilisateurs-service/{ID}/{element}', 'UtilisateurController@service');
    Route::get('/utilisateurs-representant/{ID}/{element}', 'UtilisateurController@representant');
    Route::post('/utilisateurs-marquer-interlocuteur-representant/{matricule}', 'UtilisateurController@marquerInterlocuteurRepresentant');
    Route::get('/utilisateurs-partenaire-portefeuille-retirer/{ID}', 'UtilisateurController@portefeuilleRetirer');

    //gestion des services
    Route::get('/services', 'ServiceController@index');
    Route::post('/services-create', 'ServiceController@store');
    Route::get('/services-edit/{ID}/services', 'ServiceController@edit');
    Route::post('/services-update/{ID}', 'ServiceController@update');
    Route::get('/services-delete/{ID}', 'ServiceController@delete');
    Route::get('/services-actif-inactif/{ID}', 'ServiceController@actif');

    //gestion des services clients
    Route::post('/services-client-create/{IDclient}', 'ServiceClientController@store');
    Route::post('/services-client-affecter/{IDclient}', 'ServiceClientController@storeAff');
    Route::get('/services-client-edit/{ID}/{IDclient}', 'ServiceClientController@edit');
    Route::post('/services-client-update/{ID}/{IDclient}', 'ServiceClientController@update');
    Route::get('/services-client-delete/{ID}/{IDclient}', 'ServiceClientController@delete');
    Route::get('/services-client-actif-inactif/{ID}', 'ServiceClientController@actif');

    //gestion des promotions
    Route::get('/promotions', 'PromotionController@index');
    Route::post('/promotions-create', 'PromotionController@store');
    Route::get('/promotions-edit/{ID}/promotions', 'PromotionController@edit');
    Route::post('/promotions-update/{ID}', 'PromotionController@update');
    Route::get('/promotions-delete/{ID}', 'PromotionController@delete');
    Route::get('/promotions-actif-inactif/{ID}', 'PromotionController@actif');

    //gestion des factures Aucun enregistrement
    Route::get('/factures', 'FactureController@index');
    Route::get('/factures/{matricule}/{element}/{ID}', 'FactureController@indexElement'); // element = partenaire ou client

});
