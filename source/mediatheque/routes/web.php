<?php


use App\Http\Controllers\ApprovisionnementController;
use App\Http\Controllers\DocumentAudioVisuelController;
use App\Http\Controllers\DocumentAudioVisuelElectroniqueController;
use App\Http\Controllers\LivreNumeriqueController;
use App\Http\Controllers\LivrePapierController;
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

Route::get('liste_livres_numerique', [LivreNumeriqueController::class, 'index'])->name('listeLivresNumerique');
Route::get('formulaire_enregistrement_livre_numerique', [LivreNumeriqueController::class, 'create'])->name('formulaireEnregistrementLivreNumerique');
Route::post('enregistrement_livre_numerique', [LivreNumeriqueController::class, 'store'])->name('enregistementLivreNumerique');
Route::get('affichage_livre_numerique', [LivreNumeriqueController::class, 'show'])->name('affichageLivreNumerique');
Route::get('formulaire_modification_livre_numerique', [LivreNumeriqueController::class, 'edit'])->name('formulaireModificationLivreNumerique');
Route::post('modification_livre_numerique', [LivreNumeriqueController::class, 'update'])->name('modificationLivreNumerique');
Route::delete('suppression_livre_numerique', [LivreNumeriqueController::class, 'destroy'])->name('suppressionLivreElectronique');

Route::get('liste_livres_papier', [LivrePapierController::class, 'index'])->name('listeLivresPapier');
Route::get('formulaire_enregistrement_livre_papier', [LivrePapierController::class, 'create'])->name('formulaireEnregistrementLivrePapier');
Route::post('enregistrement_livre_papier', [LivrePapierController::class, 'store'])->name('enregistementLivrePapier');
Route::get('affichage_livre_papier', [LivrePapierController::class, 'show'])->name('affichageLivrePapier');
Route::get('formulaire_modification_livre_papier', [LivrePapierController::class, 'edit'])->name('formulaireModificationLivrePapier');
Route::post('modification_livre_papier', [LivrePapierController::class, 'update'])->name('modificationLivrePapier');
Route::delete('suppression_livre_papier', [LivrePapierController::class, 'destroy'])->name('suppressionLivrePapier');

Route::get('liste_documents_audio_visuels_electroniques', [DocumentAudioVisuelElectroniqueController::class, 'index'])->name('listeDocumentsAudioVisuelsElectroniques');
Route::get('formulaire_enregistrement_document_audio_visuels_electroniques', [DocumentAudioVisuelElectroniqueController::class, 'create'])->name('formulaireEnregistrementDocumentAudioVisuelsElectroniques');
Route::post('enregistrement_document_audio_visuels_electroniques', [DocumentAudioVisuelElectroniqueController::class, 'store'])->name('enregistementDocumentAudioVisuelsElectroniques');
Route::get('affichage_document_audio_visuels_electroniques', [DocumentAudioVisuelElectroniqueController::class, 'show'])->name('affichageDocumentAudioVisuelsElectroniques');
Route::get('formulaire_modification_document_audio_visuels_electroniques', [DocumentAudioVisuelElectroniqueController::class, 'edit'])->name('formulaireModificationDocumentAudioVisuelsElectroniques');
Route::post('modification_document_audio_visuels_electroniques', [DocumentAudioVisuelElectroniqueController::class, 'update'])->name('modificationDocumentAudioVisuelsElectroniques');
Route::delete('suppression_document_audio_visuels_electroniques', [DocumentAudioVisuelElectroniqueController::class, 'destroy'])->name('suppressionDocumentAudioVisuelsElectroniques');

Route::get('liste_documents_audio_visuels', [DocumentAudioVisuelController::class, 'index'])->name('listeDocumentsAudioVisuelsElectroniques');
Route::get('formulaire_enregistrement_document_audio_visuels', [DocumentAudioVisuelController::class, 'create'])->name('formulaireEnregistrementDocumentAudioVisuelsElectroniques');
Route::post('enregistrement_document_audio_visuels', [DocumentAudioVisuelController::class, 'store'])->name('enregistementDocumentAudioVisuelsElectroniques');
Route::get('affichage_document_audio_visuels', [DocumentAudioVisuelController::class, 'show'])->name('affichageDocumentAudioVisuelsElectroniques');
Route::get('formulaire_modification_document_audio_visuels', [DocumentAudioVisuelController::class, 'edit'])->name('formulaireModificationDocumentAudioVisuelsElectroniques');
Route::post('modification_document_audio_visuels', [DocumentAudioVisuelController::class, 'update'])->name('modificationDocumentAudioVisuelsElectroniques');
Route::delete('suppression_document_audio_visuels', [DocumentAudioVisuelController::class, 'destroy'])->name('suppressionDocumentAudioVisuelsElectroniques');


Route::get('liste_approvisionnements', [ApprovisionnementController::class, 'index'])->name('listeApprovisionnements');
Route::get('formulaire_enregistrement_approvisionnement', [ApprovisionnementController::class, 'create'])->name('formulaireEnregistrementApprovisionnement');
Route::post('enregistrement_approvisionnement', [ApprovisionnementController::class, 'store'])->name('enregistementApprovisionnement');
Route::get('affichage_approvisionnement', [ApprovisionnementController::class, 'show'])->name('affichageApprovisionnement');
Route::get('formulaire_modification_approvisionnement', [ApprovisionnementController::class, 'edit'])->name('formulaireModificationApprovisionnement');
Route::post('modification_approvisionnement', [ApprovisionnementController::class, 'update'])->name('modificationApprovisionnement');
Route::delete('suppression_approvisionnement', [ApprovisionnementController::class, 'destroy'])->name('suppressionApprovisionnement');

