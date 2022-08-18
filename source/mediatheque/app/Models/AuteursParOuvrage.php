<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AuteursParOuvrage extends Pivot
{
    use HasFactory;
    protected $fillable = ['id_auteur', 'id_ouvrage', 'date_apparution', 'lieu_edition'];
    protected $primaryKey = ['id_auteur', 'id_ouvrage'];
    protected $dates = ['date_apparution'];
}
