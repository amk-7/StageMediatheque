<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AuteurOuvrage extends Pivot
{
    use HasFactory;
    protected $fillable = ['date_apparution', 'lieu_edition'];
    protected $primaryKey = ['id_auteur', 'id_ouvrage'];
    protected $dates = ['date_apparution'];

}
