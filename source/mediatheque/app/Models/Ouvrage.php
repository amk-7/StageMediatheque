<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ouvrage extends Model
{
    use HasFactory;
    protected $fillable = ['lieu_edition', 'date_apparution', 'niveau', 'type', 'image', 'langue'];
    protected $primaryKey = 'id_ouvrage';
}
