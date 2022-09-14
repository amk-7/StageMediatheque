<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LignesRestitution extends Model
{
    use HasFactory;
    protected $fillable = ['etat_entree', 'id_restitution', 'id_ouvrage_physique'];
    protected $primaryKey = 'id_ligne_restitution';

    public function ouvragesPhysique()
    {
        return $this->belongsTo(OuvragesPhysique::class, 'id_ligne_restitution');
    }

    public function restitution()
    {
        return $this->belongsTo(Restitution::class, 'id_ligne_restitution');
    }
}
