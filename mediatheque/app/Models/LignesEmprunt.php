<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LignesEmprunt extends Model
{
    use HasFactory;
    protected $fillable =['etat_sortie', 'disponibilite', 'id_ouvrage', 'id_emprunt'];
    protected $primaryKey = 'id_ligne_emprunt';

    public function updateDisponibilite()
    {
        $this->disponibilite = true;
        $this->save();
    }

    public function emprunt()
    {
        return $this->belongsTo(Emprunt::class, 'id_emprunt');
    }

    public function ouvrage()
    {
        return $this->belongsTo(Ouvrage::class, 'id_ouvrage');
    }
}
