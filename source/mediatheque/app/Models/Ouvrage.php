<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ouvrage extends Model
{
    use HasFactory;
    protected $fillable = ['titre', 'resume', 'niveau', 'type', 'image', 'langue'];
    protected $primaryKey = 'id_ouvrage';


    public function OuvragePhysique(){
        return $this->belongsTo(OuvragesPhysique::class);
    }
    public function OuvrageElectronique(){
        return $this->belongsTo(OuvragesElectronique::class);
    }

    public function auteurs()
    {
        return $this->belongsToMany(Auteur::class, "auteurs_ouvrages", "id_ouvrage", "id_auteur")
                    ->withTimestamps()
                    ->withPivot(['annee_apparution', 'lieu_edition']);

    }

    /*public function auteur_ouvrage(){
        $auteur = $this->auteur()->get()->first();
        $auteur_ouvrage = AuteurOuvrage::all()->where("id_auteur", $auteur->id_auteur)->where("id_ouvrage", $this->id_ouvrage);
        return $auteur_ouvrage;
    }*/

}
