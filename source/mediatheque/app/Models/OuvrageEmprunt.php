<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OuvrageEmprunt extends Pivot
{
    use HasFactory;
    protected $fillable =['etat', 'id_abonne'];
    protected $primaryKey = ['id_ouvrage_physique', 'id_emprunt'];
}
