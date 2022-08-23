<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auteur extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'prenom', 'date_naissance', 'date_decces'];
    protected $primaryKey = 'id_auteur';
    protected $dates = ['date_naissance', 'date_decces'];

    public function ouvrage()
    {
        return $this->belongsToMany(Ouvrage::class, "auteur_ouvrage", "id_ouvrage", "id_auteur")->using(AuteurOuvrage::class) ;
    }

    public static function getAllByOuvrage(Ouvrage $ouvrage){
        $auteur = $ouvrage->auteur()->get()->first();
        $auteur_ouvrage = AuteurOuvrage::all()->where("id_auteur", $auteur->id_auteur)->where("id_ouvrage", $ouvrage->id_ouvrage);
        return $auteur_ouvrage;
    }
}
