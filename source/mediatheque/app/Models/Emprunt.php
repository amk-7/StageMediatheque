<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprunt extends Model
{
    use HasFactory;
    protected $fillable = ['date_emprunt', 'date_retour', 'etat_retour', 'id_abonne', 'id_ouvrage_physique'];
    protected $primaryKey = 'id_emprunt';

    public function abonne()
    {
        return $this->hasOne('App\Models\Abonne', 'id_abonne');
    }

    public function ouvragePhysique()
    {
        return $this->hasOne('App\Models\OuvragePhysique', 'id_ouvrage_physique');
    }
}
