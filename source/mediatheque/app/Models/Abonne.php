<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abonne extends Model
{
    use HasFactory;
    protected $fillable = ['date_naissance', 'niveau_etude', 'profession', 'contact_a_prevenir', 'numero_carte', 'type_de_carte', 'id_utilisateur'];
    protected $primaryKey = 'id_abonne';
    protected $dates = ['date_naissance'];


    public function utilisateur(){
        return $this->belongsTo('App\Models\Utilisateur', 'id_utilisateur');
    }

    public function registration(){
        return $this->hasMany('App\Models\Registration', 'id_registraton');
    }

    public function reservation(){
        return $this->hasMany('App\Models\Reservation', 'id_reservation');
    }

    public function emprunt(){
        return $this->hasMany('App\Models\Emprunt', 'id_emprunt');
    }

    public function telechargement(){
        return $this->hasMany('App\Models\Telechargement', 'id_telechargement');
    }
}
