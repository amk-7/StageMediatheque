<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OuvrageParReservation extends Model
{
    use HasFactory;
    protected $primaryKey = ['id_ouvrage', 'id_reservation'];

}
