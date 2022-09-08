<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrations extends Model
{
    use HasFactory;
    protected $fillable = ['date_debut', 'date_fin', 'id_abonne', 'id_tarif_abonnement'];
    protected $primaryKey = 'id_registraton';
    protected $dates = ['date_debut', 'date_fin'];

    public function flooz()
    {
        return $this->hasOne('App\Models\Flooz', 'id_flooz');
    }

    public function tmoney()
    {
        return $$this->hasOne('App\Models\Tmoney', 'id_tmoney');
    }

    public function liquide()
    {
        return $this->hasOne('App\Models\Liquide', 'id_liquide');
    }

    public function abonne()
    {
        return $this->hasOne('App\Models\Abonne', 'id_abonne');
    }

    public function tarifAbonnement()
    {
        return $this->hasOne('App\Models\TarifAbonnement', 'id_tarif_abonnement');
    }
}
