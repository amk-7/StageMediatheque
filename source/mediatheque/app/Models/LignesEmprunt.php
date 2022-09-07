<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LignesEmprunt extends Model
{
    use HasFactory;
    protected $fillable =['etat_sortie', 'disponibilite', 'id_ouvrage_physique', 'id_emprunt'];
    protected $primaryKey = 'id_ligne_emprunt';

    public function emprunt()
    {
        return $this->belongsTo(Emprunt::class, 'id_ligne_emprunt');
    }

    public function ouvragesPhysique()
    {
        return $this->belongsTo(OuvragesPhysique::class, 'id_ligne_emprunt');
    }
}
