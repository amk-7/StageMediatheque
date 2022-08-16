<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OuvragePhysique extends Model
{
    use HasFactory;
    protected $fillable = ['nombre_exemplaire', 'etat', 'disponibilite', 'id_ouvrage'];
    protected $primaryKey = 'id_ouvrage_physique';
}
