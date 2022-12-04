<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = ['date_reservation', 'durre', 'etat', 'id_abonne', 'id_ouvrage_physique'];
    protected $primaryKey = 'id_reservation';
    protected $dates = ['date_reservation'];

    public function abonne()
    {
        return $this->belongsTo(Abonne::class, 'id_abonne');
    }

    public function ouvragePhysique()
    {
        return $this->belongsTo(OuvragesPhysique::class, 'id_ouvrage_physique');
    }

}
