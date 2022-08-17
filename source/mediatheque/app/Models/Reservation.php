<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = ['date_reservation', 'date_expiration', 'id_abonne', 'id_ouvrage_physique'];
    protected $primaryKey = 'id_reservation';
    protected $dates = ['date_reservation', 'date_expiration'];
}
