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
        return $this->belongsTo(Utilisateur::class);
    }
}
