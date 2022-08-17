<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registraton extends Model
{
    use HasFactory;
    protected $fillable = ['date_debut', 'date_fin', 'id_abonne', 'id_tarif_abonnement'];
    protected $primaryKey = 'id_registraton';
    protected $dates = ['date_debut', 'date_fin'];

    public function flooz()
    {
        return $this->hasOne('App\Models\Flooz');
    }

    public function tmoney()
    {
        return $$this->hasOne('App\Models\Tmoney');
    }

    public function liquide()
    {
        return $this->hasOne('App\Models\Liquide');
    }









}
