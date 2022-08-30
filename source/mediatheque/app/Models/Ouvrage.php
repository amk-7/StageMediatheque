<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Ouvrage extends Model
{
    use HasFactory, Searchable;
    protected $fillable = ['titre', 'mot_cle', 'resume', 'niveau', 'type', 'image', 'langue'];
    protected $primaryKey = 'id_ouvrage';
    protected $casts = [
        'mot_cle'=>'array'
    ];

    public function toSearchableArray()
    {
        return [
            "titre"=>$this->titre,
            "niveau"=>$this->niveau,
            "langue"=>$this->langue,
        ];
    }

    public function OuvragePhysique(){
        return $this->belongsTo(OuvragesPhysique::class, "id_ouvrage_physique");
    }
    public function OuvrageElectronique(){
        return $this->belongsTo(OuvragesElectronique::class, "id_ouvrage_electronique");
    }

    public function auteurs()
    {
        return $this->belongsToMany(Auteur::class, "auteurs_ouvrages", "id_ouvrage", "id_auteur")
                    ->withTimestamps()
                    ->withPivot(['annee_apparution', 'lieu_edition']);

    }



}
