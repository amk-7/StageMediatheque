<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approvisionnement extends Model
{
    use HasFactory;
    protected $fillable = ['nombre_exemplaire', 'id_ouvrage_physique', 'type_ouvrage', 'id_personnel', 'date_approvisonnement'];
    protected $primaryKey = 'id_approvisionnement';
    protected $dates = ['date_approvisonnement'];

    public function ouvragesPhysique(){
        return $this->belongsTo(OuvragesPhysique::class, 'id_ouvrage_physique');
    }
    public function personnel(){
        return $this->belongsTo(Personnel::class, 'id_personnel');
    }
}
