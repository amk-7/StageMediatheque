<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OuvrageParEmprunt extends Pivot
{
    use HasFactory;
    protected $primaryKey = ['id_ouvrage', 'id_emprunt'];
}
