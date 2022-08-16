<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'prenom', 'nom_utilisateur', 'email', 'mot_de_passe', 'contact', 'profil', 'adresse', 'sexe'];
    protected $primaryKey = 'id_utilisateur';

    public function abonne()
    {
        return $this->hasOne('App\Models\Abonne');
    }

    public function personnel()
    {
        return $$this->hasOne('App\Models\Personnel');
    }


}
