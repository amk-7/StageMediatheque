<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $fillable = ['date_debut', 'date_fin', 'id_abonne', 'id_tarif_abonnement', 'etat'];
    protected $primaryKey = 'id_registration';
    protected $dates = ['date_debut', 'date_fin'];

    public function flooz()
    {
        return $this->hasOne('App\Models\Flooz', 'id_flooz');
    }

    public function tmoney()
    {
        return $this->hasOne('App\Models\Tmoney', 'id_tmoney');
    }

    public function liquide()
    {
        return $this->hasOne('App\Models\Liquide', 'id_registration');
    }

    public function abonne()
    {
        return $this->belongsTo('App\Models\Abonne', 'id_abonne');
    }

    public function tarifAbonnement()
    {
        return $this->belongsTo('App\Models\TarifAbonnement', 'id_tarif_abonnement');
    }

    public function estValide()
    {
        return $this->etat == 1;
    }
}
