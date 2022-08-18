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

    public function ouvrage()
    {
        return $this->belongsToMany(Ouvrage::class)->using(AuteursParOuvrage::class) ;
    }
}
