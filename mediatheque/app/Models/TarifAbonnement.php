<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarifAbonnement extends Model
{
    use HasFactory;
    protected $fillable = ['tarif', 'duree_validite', 'designation'];
    protected $primaryKey = 'id_tarif_abonnement';

    public function registrations(){
        return $this->hasMany('App\Models\Registration', 'id_tarif_abonnement');
    }
}
