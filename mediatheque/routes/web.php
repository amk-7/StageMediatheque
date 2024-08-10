<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApprovisionnementsController;
use App\Http\Controllers\RestitutionController;
use App\Http\Controllers\AbonneController;
use App\Http\Controllers\OuvrageController;
use App\Http\Controllers\EmpruntController;
use App\Http\Controllers\LiquideController;
use App\Http\Controllers\PersonnelController;

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
    Route::get('liste_mes_emprunts/{abonne}', [AbonneController::class, 'mesEmprunts'])->name('ListemesEmprunts');
    Route::get('liste_mes_emprunts_actuelle/{abonne}', [AbonneController::class, 'mesEmpruntsEnCours'])->name('ListemesEmpruntsActuelle');
    //Route::post('enregistrer_une_reservation', [\App\Http\Controllers\ReservationController::class, 'store'])->name('enregistrerReservation');
});

Route::group(['middleware' => ['role:bibliothecaire|abonne', 'auth']], function () {
    //Route::get('liste_des_reservations', [ReservationController::class, 'index'])->name('listeReservations');
    //Route::delete('suppression_reservation/{reservation}', [ReservationController::class, 'destroy'])->name('destroyReservation');
    Route::get('affiche_abonne/{abonne}', [AbonneController::class, 'show'])->name('showAbonne');
    Route::get('formulaire_edition_des_abonnes/{abonne}/edit', [AbonneController::class, 'edit'])->name('editAbonne');
    Route::put('mise_a_jour_des_abonnes/{abonne}', [AbonneController::class, 'update'])->name('updateAbonne');
    Route::get('affiche_emprunt/{emprunt}', [EmpruntController::class, 'show'])->name('showEmprunt');
    Route::get('lire_pdf/{ouvrage}/lecture', [OuvrageController::class, 'readPdf'])->name('lirePDF');
});

Route::group(['middleware' => ['role:bibliothecaire', 'auth']], function () {
    Route::get('exporter_ouvrages', [OuvrageController::class, 'export'])->name('exporter_ouvrages');
    Route::get('exporter_abonnements', [LiquideController::class, 'export'])->name('exporter_abonnements');
    Route::post('import_abonne', [AbonneController::class, 'importExcel'])->name('import_abonne');

    Route::get('imprimerCote', [OuvrageController::class, 'imprimerCote'])->name('imprimerCote');
    Route::get('formulaire_enregistrement_approvisionnements', [ApprovisionnementsController::class, 'create'])->name('formulaireEnregistrementApprovisionnements');

    // Path: Abonne routes/web.php
    Route::get('liste_des_abonnes', [AbonneController::class, 'index'])->name('listeAbonnes');
    Route::delete('suppression_des_abonnes/{abonne}/', [AbonneController::class, 'destroy'])->name('destroyAbonne');
    Route::get('formulaire_Abonne', [AbonneController::class, 'create'])->name('createAbonne');

    Route::put('activer_abonne/{abonne}', [AbonneController::class, 'fenix_user'])->name('fenix_user');

    // Path: Emprunt routes/web.php
    Route::get('liste_des_emprunts', 'App\Http\Controllers\EmpruntController@index')->name('listeEmprunts');
    Route::get('formulaire_edition_emprunts/{emprunt}/edition', 'App\Http\Controllers\EmpruntController@edit')->name('editEmprunt');
    Route::put('mise_a_jour_des_emprunts/{emprunt}', 'App\Http\Controllers\EmpruntController@update')->name('updateEmprunt');
    Route::delete('suppression_des_emprunts/{emprunt}', 'App\Http\Controllers\EmpruntController@destroy')->name('destroyEmprunt');
    Route::get('formulaire_Emprunt', 'App\Http\Controllers\EmpruntController@create')->name('createEmprunt');
    Route::post('enregistrement_emprunt', 'App\Http\Controllers\EmpruntController@store')->name('storeEmprunt');

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



    Route::get('liste_des_restitutions', [RestitutionController::class, 'index'])->name('listeRestitutions');
    Route::get('formulaire_enregistrement_restitution/{emprunt}/formulaire', [RestitutionController::class, 'create'])->name('formulaireEnregistrementRestitution');
    Route::post('enregistrement_restitution', [RestitutionController::class, 'store'])->name('enregistementRestitution');
    Route::get('affichage_restitution/{restitution}/afficher', [RestitutionController::class, 'show'])->name('affichageRestitution');
    Route::get('formulaire_modification_restitution/{restitution}/editer', [RestitutionController::class, 'edit'])->name('formulaireModificationRestitution');
    Route::post('modification_restitution/{restitution}', [RestitutionController::class, 'update'])->name('modificationRestitution');
    Route::delete('suppression_restitution', [RestitutionController::class, 'destroy'])->name('suppressionRestitution');

    Route::post('enregistrement_abonne', 'App\Http\Controllers\AbonneController@store')->name('storeAbonne');

    Route::get('/ouvrages', [OuvrageController::class, 'index'])->name('ouvrages.index');
    Route::get('/ouvrages/create/', [OuvrageController::class, 'create'])->name('ouvrages.create');
    Route::post('/ouvrages/store/', [OuvrageController::class, 'store'])->name('ouvrages.store');
    Route::get('/ouvrages/{ouvrage}/edit', [OuvrageController::class, 'edit'])->name('ouvrages.edit');
    Route::put('/ouvrages/{ouvrage}/', [OuvrageController::class, 'update'])->name('ouvrages.update');
    Route::delete('/ouvrages/{ouvrage}', [OuvrageController::class, 'destroy'])->name('ouvrages.destroy');

    Route::get('liste_approvisionnements', [ApprovisionnementsController::class, 'index'])->name('approvisionnements.index');
    Route::post('enregistrement_approvisionnements', [ApprovisionnementsController::class, 'store'])->name('approvisionnements.store');
    Route::get('affichage_approvisionnements', [ApprovisionnementsController::class, 'show'])->name('affichageApprovisionnements');
    Route::get('formulaire_modification_approvisionnements/{approvisionnements}/modification/', [ApprovisionnementsController::class, 'edit'])->name('approvisionnements.edit');
    Route::put('modification_approvisionnements/{approvisionnement}/', [ApprovisionnementsController::class, 'update'])->name('modificationApprovisionnements');
    Route::delete('approvisionnements/{approvisionnement}/', [ApprovisionnementsController::class, 'destroy'])->name('approvisionnements.delete');

});

Route::group(['middleware' => ['role:responsable', 'auth']], function () {
    Route::get('formulaire_import_excel_new', [OuvrageController::class, 'uploadLivresPapierView'])->name('formulaireImportExcelNew');
    Route::put('enregistrement_import_excel_new', [OuvrageController::class, 'import'])->name('enregistrementImportExcelNew');

    // Route::post('import_personnel', [PersonnelController::class, 'import'])->name('import_personnel');
    // Route::get('export_personnel', [PersonnelController::class, 'export'])->name('export_personnel');


    // Path: Personnel routes/web.php
    Route::get('liste_des_personnels', 'App\Http\Controllers\PersonnelController@index')->name('listePersonnels');
    Route::get('affiche_personnel/{personnel}', 'App\Http\Controllers\PersonnelController@show')->name('showPersonnel');
    Route::get('formulaire_edition_des_personnels/{personnel}/edition', 'App\Http\Controllers\PersonnelController@edit')->name('editPersonnel');
    Route::put('mise_a_jour_des_personnels/{personnel}', 'App\Http\Controllers\PersonnelController@update')->name('updatePersonnel');
    Route::delete('suppression_des_personnels/{personnel}', 'App\Http\Controllers\PersonnelController@destroy')->name('destroyPersonnel');
    Route::get('formulaire_Personnel', 'App\Http\Controllers\PersonnelController@create')->name('createPersonnel');
    Route::post('enregistrement_personnel', 'App\Http\Controllers\PersonnelController@store')->name('storePersonnel');
});


Route::fallback(function () {
    return view('404');
});




require __DIR__ . '/auth.php';
