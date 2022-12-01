<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = ['date_reservation', 'etat', 'id_abonne', 'id_ouvrage_physique'];
    protected $primaryKey = 'id_reservation';
    protected $dates = ['date_reservation'];

    public function abonne()
    {
        return $this->hasOne('App\Models\Abonne', 'id_abonne');
    }

    public function ouvragePhysique()
    {
        return $this->belongsToMany(OuvragesPhysique::class)->using(OuvrageReservation::class);
    }

}
