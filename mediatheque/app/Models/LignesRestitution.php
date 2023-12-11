<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Http\Controllers\Controller;


class LignesRestitution extends Model
{
    use HasFactory;
    protected $fillable = ['etat_entree', 'id_restitution', 'id_ouvrage_physique'];
    protected $primaryKey = 'id_ligne_restitution';

    public static function enregistrerLignesRestitution($datas, $id_restitution, $id_emprunt)
    {
        for ($i=1; $i < count($datas)-1; $i++){
            self::enregistrerUneLigneRestitution($datas[$i][0], $datas[$i][1], $id_restitution, $id_emprunt);
        }
    }

    public static function enregistrerUneLigneRestitution($id_ouvrage, $etat_entree, $id_restitution, $id_emprunt)
    {
        $etat_entree = trim($etat_entree) ;
        if ($etat_entree == '-'){
            return;
        }
        $ouvrage = Ouvrage::where('cote', $id_ouvrage)->get()->first();
        //dd($id_ouvrage);

        if(strtolower($etat_entree)=="perdus"){
            $ouvrage->augmenterNombreExemplaire(-1);
        }else {
            $ouvrage->augmenterNombreExemplaire(1);
        }

        LignesRestitution::create([
            'id_ouvrage' => $ouvrage->id_ouvrage,
            'id_restitution' => $id_restitution,
            'etat_entree' => array_search($etat_entree, Controller::demanderEtat()),
        ]);
        $ligne_emprunt = LignesEmprunt::all()->where('id_emprunt', $id_emprunt)->where('id_ouvrage', $ouvrage->id_ouvrage)->first();
        $ligne_emprunt->updateDisponibilite();
    }

    public function ouvragesPhysique()
    {
        return $this->belongsTo(OuvragesPhysique::class, 'id_ouvrage_physique');
    }

    public function restitution()
    {
        return $this->belongsTo(Restitution::class, 'id_restitution');
    }
}
