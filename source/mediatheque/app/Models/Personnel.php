<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;
    protected $fillable = ['statut', 'id_utilisateur'];
    protected $primaryKey = 'id_personnel';


    public function utilisateur(){
        return $this->belongsTo('App\Models\Utilisateur', 'id_utilisateur');
    }

    public function approvisionnement(){
        return $this->hasOne('App\Models\Approvisionnement', 'id_approvisionnement');
    }
}
