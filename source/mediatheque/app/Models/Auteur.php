<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auteur extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'prenom'];
    protected $primaryKey = 'id_auteur';

    public function ouvrages()
    {
        return $this->belongsToMany(Ouvrage::class, "auteur_ouvrage", "id_ouvrage", "id_auteur")
                    ->withTimestamps()
                    ->withPivot(['annee_apparution', 'lieu_edition']);

    }

}
