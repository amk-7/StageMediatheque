<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approvisionnement extends Model
{
    use HasFactory;
    protected $fillable = ['nombre_exemplaire', 'id_ouvrage_physique', 'id_personnel', 'date_approvisonnement'];
    protected $primaryKey = 'id_approvisionnement';
    protected $dates = ['date_approvisonnement'];
}
