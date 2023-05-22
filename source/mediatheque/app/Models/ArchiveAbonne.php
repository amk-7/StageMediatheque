<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchiveAbonne extends Model
{
    use HasFactory;
    protected $fillable = ['date_naissance', 'profil_valider','niveau_etude', 'profession', 'contact_a_prevenir', 'numero_carte', 'type_de_carte', 'id_utilisateur'];
    protected $primaryKey = 'id_abonne';
    protected $dates = ['date_naissance'];

    public function utilisateur(){
        return $this->belongsTo('App\Models\User', 'id_utilisateur');
    }

   
}
