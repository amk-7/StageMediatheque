<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApprovisionnementsController;
use App\Http\Controllers\RestitutionController;
use App\Http\Controllers\AbonneController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\OuvrageController;
use App\Http\Controllers\EmpruntController;
use App\Http\Controllers\LangueController;
use App\Http\Controllers\LiquideController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\TypesOuvragesController;

// use App\Http\Controllers\ReservationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [OuvrageController::class, 'welcome'])->name('welcome');
Route::get('/ouvrages/show/{ouvrage}', [OuvrageController::class, 'show'])->name('ouvrages.show');

Route::group(['middleware' => ['role:abonne', 'auth']], function () {
    
});

Route::group(['middleware' => ['role:bibliothecaire|abonne', 'auth']], function () {

});

Route::group(['middleware' => ['role:bibliothecaire', 'auth']], function () {

    
    Route::get('abonnes', [AbonneController::class, 'index'])->name('abonnes.index');
    Route::get('abonnes/create/', [AbonneController::class, 'create'])->name('abonnes.create');
    Route::post('abonnes/store/', [AbonneController::class, 'store'])->name('abonnes.store');
    Route::get('abonnes/{ouvrage}/edit', [AbonneController::class, 'edit'])->name('abonnes.edit');
    Route::get('abonnes/{ouvrage}/show', [AbonneController::class, 'show'])->name('abonnes.show');
    Route::put('abonnes/{ouvrage}/', [AbonneController::class, 'update'])->name('abonnes.update');
    Route::delete('abonnes/{ouvrage}', [AbonneController::class, 'destroy'])->name('abonnes.destroy');
    Route::put('abonnes/{abonne}/activer', [AbonneController::class, 'fenix_user'])->name('fenix_user');

    Route::get('imprimerCote', [OuvrageController::class, 'imprimerCote'])->name('imprimerCote');
    Route::get('formulaire_enregistrement_approvisionnements', [ApprovisionnementsController::class, 'create'])->name('formulaireEnregistrementApprovisionnements');


    Route::get('emprunts', [EmpruntController::class, 'index'])->name('emprunts.index');
    Route::get('emprunts/create/', [EmpruntController::class, 'create'])->name('emprunts.create');
    Route::post('emprunts/store/', [EmpruntController::class, 'store'])->name('emprunts.store');
    Route::get('emprunts/{emprunt}/edit', [EmpruntController::class, 'edit'])->name('emprunts.edit');
    Route::get('emprunts/{emprunt}/show', [EmpruntController::class, 'show'])->name('emprunts.show');
    Route::put('emprunts/{emprunt}/', [EmpruntController::class, 'update'])->name('emprunts.update');
    Route::delete('emprunts/{emprunt}', [EmpruntController::class, 'destroy'])->name('emprunts.destroy');

    
    Route::get('download_excel_liste_abonnes', [AbonneController::class, 'exportExcel'])->name('downloadExcelListeAbonnes');
    Route::get('download_excel_liste_emprunts', [EmpruntController::class, 'exportExcel'])->name('downloadExcelListeEnprunt');

    // Path: TarifAbonnement routes/web.php
    Route::get('liste_des_tarif_abonnements', 'App\Http\Controllers\TarifAbonnementController@index')->name('listeTarifAbonnements');
    Route::get('affiche_tarif_abonnement', 'App\Http\Controllers\TarifAbonnementController@show')->name('showTarifAbonnement');
    Route::get('formulaire_edition_des_tarif_abonnements', 'App\Http\Controllers\TarifAbonnementController@edit')->name('editTarifAbonnement');
    Route::put('mise_a_jour_des_tarif_abonnements', 'App\Http\Controllers\TarifAbonnementController@update')->name('updateTarifAbonnement');
    Route::delete('suppression_des_tarif_abonnements', 'App\Http\Controllers\TarifAbonnementController@destroy')->name('destroyTarifAbonnement');
    Route::get('formulaire_TarifAbonnement', 'App\Http\Controllers\TarifAbonnementController@create')->name('createTarifAbonnement');
    Route::post('enregistrement_tarif_abonnement', 'App\Http\Controllers\TarifAbonnementController@store')->name('storeTarifAbonnement');

    // Path: liquide routes/web.php
    Route::get('liste_des_liquides', 'App\Http\Controllers\LiquideController@index')->name('listeLiquides');
    Route::get('formulaire_liquide', 'App\Http\Controllers\LiquideController@create')->name('createLiquide');
    Route::delete('suppression_liquide/{liquide}/', 'App\Http\Controllers\LiquideController@destroy')->name('destroyOneLiquide');
    Route::delete('suppression_des_liquides', 'App\Http\Controllers\LiquideController@delete_all')->name('destroyLiquide');
    Route::post('enregistrement_liquide', 'App\Http\Controllers\LiquideController@store')->name('storeLiquide');


    Route::get('restitutions', [RestitutionController::class, 'index'])->name('restitutions.index');
    Route::get('restitutions/{emprunt}/create/', [RestitutionController::class, 'create'])->name('restitutions.create');
    Route::post('restitutions/store/', [RestitutionController::class, 'store'])->name('restitutions.store');
    Route::get('restitutions/{restitution}/edit', [RestitutionController::class, 'edit'])->name('restitutions.edit');
    Route::put('restitutions/{restitution}/', [RestitutionController::class, 'update'])->name('restitutions.update');
    Route::delete('restitutions/{restitution}', [RestitutionController::class, 'destroy'])->name('restitutions.destroy');

    Route::get('ouvrages', [OuvrageController::class, 'index'])->name('ouvrages.index');
    Route::get('ouvrages/create/', [OuvrageController::class, 'create'])->name('ouvrages.create');
    Route::post('ouvrages/store/', [OuvrageController::class, 'store'])->name('ouvrages.store');
    Route::get('ouvrages/{ouvrage}/edit', [OuvrageController::class, 'edit'])->name('ouvrages.edit');
    Route::put('ouvrages/{ouvrage}/', [OuvrageController::class, 'update'])->name('ouvrages.update');
    Route::delete('ouvrages/{ouvrage}', [OuvrageController::class, 'destroy'])->name('ouvrages.destroy');

    Route::get('exporter_ouvrages', [OuvrageController::class, 'export'])->name('exporter_ouvrages');
    Route::get('exporter_abonnements', [LiquideController::class, 'export'])->name('exporter_abonnements');
    Route::post('import_abonne', [AbonneController::class, 'importExcel'])->name('import_abonne');


    Route::get('approvisionnements', [ApprovisionnementsController::class, 'index'])->name('approvisionnements.index');
    Route::get('approvisionnements/create/', [ApprovisionnementsController::class, 'create'])->name('approvisionnements.create');
    Route::post('approvisionnements/store/', [ApprovisionnementsController::class, 'store'])->name('approvisionnements.store');
    Route::get('approvisionnements/{approvisionnement}/edit', [ApprovisionnementsController::class, 'edit'])->name('approvisionnements.edit');
    Route::put('approvisionnements/{approvisionnement}/', [ApprovisionnementsController::class, 'update'])->name('approvisionnements.update');
    Route::delete('approvisionnements/{approvisionnement}', [ApprovisionnementsController::class, 'destroy'])->name('approvisionnements.destroy');

});

Route::group(['middleware' => ['role:responsable', 'auth']], function () {
    Route::resource('domaines', DomaineController::class);
    Route::resource('types_ouvrages', TypesOuvragesController::class);
    Route::resource('langues', LangueController::class);
    Route::resource('niveaux', NiveauController::class);

    Route::get('ouvrages/excel/import', [OuvrageController::class, 'uploadLivresPapierView'])->name('ouvrages.excel_import');
    Route::put('enregistrement_import_excel_new', [OuvrageController::class, 'import'])->name('enregistrementImportExcelNew');

    // Path: Personnel routes/web.php
   
    Route::get('personnels', [PersonnelController::class, 'index'])->name('personnels.index');
    Route::get('personnels/create/', [PersonnelController::class, 'create'])->name('personnels.create');
    Route::post('personnels/store/', [PersonnelController::class, 'store'])->name('personnels.store');
    Route::get('personnels/{personnel}/edit', [PersonnelController::class, 'edit'])->name('personnels.edit');
    Route::get('personnels/{personnel}/show', [PersonnelController::class, 'show'])->name('personnels.show');
    Route::put('personnels/{personnel}/', [PersonnelController::class, 'update'])->name('personnels.update');
    Route::delete('personnels/{personnel}', [PersonnelController::class, 'destroy'])->name('personnels.destroy');
    Route::put('personnels/{abonne}/activer', [PersonnelController::class, 'fenix_user'])->name('fenix_user');

});


Route::fallback(function () {
    return view('404');
});




require __DIR__ . '/auth.php';
