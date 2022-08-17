<?php


use App\Http\Controllers\LivreNumeriqueController;
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

Route::get('liste_des_livres_numerique', [LivreNumeriqueController::class, 'index'])->name('listeLivresNumerique');
Route::get('formulaire_enregistrement_livre_numerique', [LivreNumeriqueController::class, 'create'])->name('formulaireEnregistrementLivreNumerique');
Route::post('enregistrement_livre_numerique', [LivreNumeriqueController::class, 'store'])->name('enregistementLivreNumerique');
Route::get('affichage_livre_numerique', [LivreNumeriqueController::class, 'show'])->name('affichageLivreNumerique');
Route::get('formulaire_modification_livre_numerique', [LivreNumeriqueController::class, 'edit'])->name('formulaireModificationLivreNumerique');
Route::post('modification_livre_numerique', [LivreNumeriqueController::class, 'update'])->name('modificationLivreNumerique');
Route::delete('suppression_livre_numerique', [LivreNumeriqueController::class, 'destroy'])->name('suppressionLivreElectronique');
