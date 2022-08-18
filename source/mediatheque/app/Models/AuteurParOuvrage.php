<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AuteurParOuvrage extends Pivot
{
    use HasFactory;
    protected $fillable = ['id_auteur', 'id_ouvrage', 'date_apparution'];
    protected $primaryKey = ['id_auteur', 'id_ouvrage'];
    protected $dates = ['date_apparution'];
}
