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
        return $this->belongsTo('App\Models\User', 'id_utilisateur');
    }

    public function approvisionnements(){
        return $this->hasMany(Approvisionnement::class, 'id_approvisionnement');
    }

    public function restitutions(){
        return $this->hasMany(Restitution::class, 'id_restitution');
    }
}
