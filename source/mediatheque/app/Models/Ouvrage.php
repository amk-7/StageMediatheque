<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ouvrage extends Model
{
    use HasFactory;
    protected $fillable = ['titre', 'mot_cle', 'resume', 'niveau', 'type', 'image', 'langue', 'annee_apparution', 'lieu_edition', 'ressources_externe'];
    protected $primaryKey = 'id_ouvrage';
    protected $casts = [
        'mot_cle'=>'array'
    ];

    public function OuvragesPhysique(){
        return $this->hasOne(OuvragesPhysique::class, "id_ouvrage_physique");
    }

    public function OuvrageElectronique(){
        return $this->hasOne(OuvragesElectronique::class, "id_ouvrage_electronique");
    }

    public function auteurs()
    {
        return $this->belongsToMany(Auteur::class, "auteurs_ouvrages", "id_ouvrage", "id_auteur")
                    ->withTimestamps();
    }
}
