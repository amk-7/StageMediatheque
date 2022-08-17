<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprunt extends Model
{
    use HasFactory;
    protected $fillable = ['date_emprunt', 'date_retour', 'etat_retour', 'id_abonne', 'id_ouvrage_physique'];
    protected $primaryKey = 'id_emprunt';
    protected $dates = ['date_emprunt', 'date_retour'];
}
