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

    public function ouvrages()
    {
        return $this->belongsToMany(Ouvrage::class, "auteur_ouvrage", "id_ouvrage", "id_auteur")
                    ->withTimestamps()
                    ->withPivot(['annee_apparution', 'lieu_edition']);

    }

}
