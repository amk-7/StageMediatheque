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

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];

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
