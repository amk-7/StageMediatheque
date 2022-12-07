<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Registration extends Model
{
    use HasFactory;
    protected $fillable = ['date_debut', 'date_fin', 'id_abonne', 'id_tarif_abonnement'];
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
        return $this->hasOne('App\Models\TarifAbonnement', 'id_tarif_abonnement');
    }

    public function estValide()
    {
        return ! Carbon::now()->gt($this->date_fin);
    }
}
