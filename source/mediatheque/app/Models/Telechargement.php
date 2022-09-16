<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telechargement extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'id_ouvrage_electronique', 'id_abonne'];
    protected $primaryKey = 'id_telechargement';
    protected $dates = ['date'];
}
