<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});











// Path: Abonne routes/web.php
Route::get('liste_des_abonnes', 'App\Http\Controllers\AbonneController@index')->name('listeAbonnes');
Route::get('affiche_abonne', 'App\Http\Controllers\AbonneController@show')->name('showAbonne');
Route::get('formulaire_edition_des_abonnes', 'App\Http\Controllers\AbonneController@edit')->name('editAbonne');
Route::put('mise_a_jour_des_abonnes', 'App\Http\Controllers\AbonneController@update')->name('updateAbonne');
Route::delete('suppression_des_abonnes', 'App\Http\Controllers\AbonneController@destroy')->name('destroyAbonne');
Route::get('formulaire_Abonne', 'App\Http\Controllers\AbonneController@create')->name('createAbonne');
Route::post('enregistrement_des_abonnes', 'App\Http\Controllers\AbonneController@store')->name('storeAbonne');

// Path: Personnel routes/web.php
Route::get('liste_des_personnels', 'App\Http\Controllers\PersonnelController@index')->name('listePersonnels');
Route::get('affiche_personnel', 'App\Http\Controllers\PersonnelController@show')->name('showPersonnel');
Route::get('formulaire_edition_des_personnels', 'App\Http\Controllers\PersonnelController@edit')->name('editPersonnel');
Route::put('mise_a_jour_des_personnels', 'App\Http\Controllers\PersonnelController@update')->name('updatePersonnel');
Route::delete('suppression_des_personnels', 'App\Http\Controllers\PersonnelController@destroy')->name('destroyPersonnel');
Route::get('formulaire_Personnel', 'App\Http\Controllers\PersonnelController@create')->name('createPersonnel');
Route::post('enregistrement_des_personnels', 'App\Http\Controllers\PersonnelController@store')->name('storePersonnel');

// Path: Emprunt routes/web.php
Route::get('liste_des_emprunts', 'App\Http\Controllers\EmpruntController@index')->name('listeEmprunts');
Route::get('affiche_emprunt', 'App\Http\Controllers\EmpruntController@show')->name('showEmprunt');
Route::get('formulaire_edition_des_emprunts', 'App\Http\Controllers\EmpruntController@edit')->name('editEmprunt');
Route::put('mise_a_jour_des_emprunts', 'App\Http\Controllers\EmpruntController@update')->name('updateEmprunt');
Route::delete('suppression_des_emprunts', 'App\Http\Controllers\EmpruntController@destroy')->name('destroyEmprunt');
Route::get('formulaire_Emprunt', 'App\Http\Controllers\EmpruntController@create')->name('createEmprunt');
Route::post('enregistrement_des_emprunts', 'App\Http\Controllers\EmpruntController@store')->name('storeEmprunt');

// Path: Reservation routes/web.php
Route::get('liste_des_reservations', 'App\Http\Controllers\ReservationController@index')->name('listeReservations');
Route::get('affiche_reservation', 'App\Http\Controllers\ReservationController@show')->name('showReservation');
Route::get('formulaire_edition_des_reservations', 'App\Http\Controllers\ReservationController@edit')->name('editReservation');
Route::put('mise_a_jour_des_reservations', 'App\Http\Controllers\ReservationController@update')->name('updateReservation');
Route::delete('suppression_des_reservations', 'App\Http\Controllers\ReservationController@destroy')->name('destroyReservation');
Route::get('formulaire_Reservation', 'App\Http\Controllers\ReservationController@create')->name('createReservation');
Route::post('enregistrement_des_reservations', 'App\Http\Controllers\ReservationController@store')->name('storeReservation');

// Path: ClassificationDeweyCentaine routes/web.php
Route::get('liste_des_classification_dewey_centaines', 'App\Http\Controllers\ClassificationDeweyCentaineController@index')->name('listeClassificationDeweyCentaines');
Route::get('affiche_classification_dewey_centaine', 'App\Http\Controllers\ClassificationDeweyCentaineController@show')->name('showClassificationDeweyCentaine');
Route::get('formulaire_edition_des_classification_dewey_centaines', 'App\Http\Controllers\ClassificationDeweyCentaineController@edit')->name('editClassificationDeweyCentaine');
Route::put('mise_a_jour_des_classification_dewey_centaines', 'App\Http\Controllers\ClassificationDeweyCentaineController@update')->name('updateClassificationDeweyCentaine');
Route::delete('suppression_des_classification_dewey_centaines', 'App\Http\Controllers\ClassificationDeweyCentaineController@destroy')->name('destroyClassificationDeweyCentaine');
Route::get('formulaire_ClassificationDeweyCentaine', 'App\Http\Controllers\ClassificationDeweyCentaineController@create')->name('createClassificationDeweyCentaine');
Route::post('enregistrement_des_classification_dewey_centaines', 'App\Http\Controllers\ClassificationDeweyCentaineController@store')->name('storeClassificationDeweyCentaine');

// Path: TarifAbonnement routes/web.php
Route::get('liste_des_tarif_abonnements', 'App\Http\Controllers\TarifAbonnementController@index')->name('listeTarifAbonnements');
Route::get('affiche_tarif_abonnement', 'App\Http\Controllers\TarifAbonnementController@show')->name('showTarifAbonnement');
Route::get('formulaire_edition_des_tarif_abonnements', 'App\Http\Controllers\TarifAbonnementController@edit')->name('editTarifAbonnement');
Route::put('mise_a_jour_des_tarif_abonnements', 'App\Http\Controllers\TarifAbonnementController@update')->name('updateTarifAbonnement');
Route::delete('suppression_des_tarif_abonnements', 'App\Http\Controllers\TarifAbonnementController@destroy')->name('destroyTarifAbonnement');
Route::get('formulaire_TarifAbonnement', 'App\Http\Controllers\TarifAbonnementController@create')->name('createTarifAbonnement');
Route::post('enregistrement_des_tarif_abonnements', 'App\Http\Controllers\TarifAbonnementController@store')->name('storeTarifAbonnement');

// Path: Registration routes/web.php
Route::get('liste_des_registrations', 'App\Http\Controllers\RegistrationController@index')->name('listeRegistrations');
Route::get('affiche_registration', 'App\Http\Controllers\RegistrationController@show')->name('showRegistration');
Route::get('formulaire_edition_des_registrations', 'App\Http\Controllers\RegistrationController@edit')->name('editRegistration');
Route::put('mise_a_jour_des_registrations', 'App\Http\Controllers\RegistrationController@update')->name('updateRegistration');
Route::delete('suppression_des_registrations', 'App\Http\Controllers\RegistrationController@destroy')->name('destroyRegistration');
Route::get('formulaire_Registration', 'App\Http\Controllers\RegistrationController@create')->name('createRegistration');
Route::post('enregistrement_des_registrations', 'App\Http\Controllers\RegistrationController@store')->name('storeRegistration');

// Path: Tmoney routes/web.php
Route::get('liste_des_tmoney', 'App\Http\Controllers\TmoneyController@index')->name('listeTmoney');
Route::get('affiche_tmoney', 'App\Http\Controllers\TmoneyController@show')->name('showTmoney');
Route::get('formulaire_edition_des_tmoney', 'App\Http\Controllers\TmoneyController@edit')->name('editTmoney');
Route::put('mise_a_jour_des_tmoney', 'App\Http\Controllers\TmoneyController@update')->name('updateTmoney');
Route::delete('suppression_des_tmoney', 'App\Http\Controllers\TmoneyController@destroy')->name('destroyTmoney');
Route::get('formulaire_Tmoney', 'App\Http\Controllers\TmoneyController@create')->name('createTmoney');
Route::post('enregistrement_des_tmoney', 'App\Http\Controllers\TmoneyController@store')->name('storeTmoney');

// Path: Flooz routes/web.php
Route::get('liste_des_flooz', 'App\Http\Controllers\FloozController@index')->name('listeFlooz');
Route::get('affiche_flooz', 'App\Http\Controllers\FloozController@show')->name('showFlooz');
Route::get('formulaire_edition_des_flooz', 'App\Http\Controllers\FloozController@edit')->name('editFlooz');
Route::put('mise_a_jour_des_flooz', 'App\Http\Controllers\FloozController@update')->name('updateFlooz');
Route::delete('suppression_des_flooz', 'App\Http\Controllers\FloozController@destroy')->name('destroyFlooz');
Route::get('formulaire_Flooz', 'App\Http\Controllers\FloozController@create')->name('createFlooz');
Route::post('enregistrement_des_flooz', 'App\Http\Controllers\FloozController@store')->name('storeFlooz');

// Path: liquide routes/web.php
Route::get('liste_des_liquides', 'App\Http\Controllers\LiquideController@index')->name('listeLiquides');
Route::get('affiche_liquide', 'App\Http\Controllers\LiquideController@show')->name('showLiquide');
Route::get('formulaire_edition_des_liquides', 'App\Http\Controllers\LiquideController@edit')->name('editLiquide');
Route::put('mise_a_jour_des_liquides', 'App\Http\Controllers\LiquideController@update')->name('updateLiquide');
Route::delete('suppression_des_liquides', 'App\Http\Controllers\LiquideController@destroy')->name('destroyLiquide');
Route::get('formulaire_Liquide', 'App\Http\Controllers\LiquideController@create')->name('createLiquide');
Route::post('enregistrement_des_liquides', 'App\Http\Controllers\LiquideController@store')->name('storeLiquide');




