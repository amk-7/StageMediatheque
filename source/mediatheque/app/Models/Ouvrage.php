<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ouvrage extends Model
{
    use HasFactory;
    protected $fillable = ['titre', 'niveau', 'type', 'image', 'langue'];
    protected $primaryKey = 'id_ouvrage';


    public function OuvragePhysique(){
        return $this->belongsTo(OuvragesPhysique::class, "id_ouvrage_physique");
    }
    public function OuvrageElectronique(){
        return $this->belongsTo(OuvragesElectronique::class, "id_ouvrage_electronique");
    }

    public function auteur()
    {
        return $this->belongsToMany(Auteur::class, "auteur_ouvrage", "id_ouvrage", "id_auteur")->using(AuteurOuvrage::class);
    }

}
