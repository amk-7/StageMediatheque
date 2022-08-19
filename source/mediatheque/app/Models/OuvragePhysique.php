<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OuvragePhysique extends Model
{
    use HasFactory;
    protected $fillable = ['nombre_exemplaire', 'etat', 'disponibilite', 'id_ouvrage', 'id_classification_dewey_dizaine'];
    protected $primaryKey = 'id_ouvrage_physique';

    public function ouvrage(){
        return $this->hasOne(Ouvrage::class);
    }
    public function classification_dewey_dizaine(){
        return $this->belongsTo(ClassificationDeweyDizaines::class);
    }
    public function livrePapier(){
        return $this->belongsTo(LivrePapier::class);
    }
    public function documentAudioVisuel(){
        return $this->belongsTo(DocumentAudioVisuel::class);
    }

    public function restitution(){
        return $this->belongsToMany(Restitution::class)->using(RestitutionOuvragePhysique::class);
    }    
    public function emprunt()
    {
        return $this->belongsToMany(Emprunt::class)->using(OuvrageParEmprunt::class);
    }
    public function reservation()
    {
        return $this->belongsToMany(Reservation::class)->using(OuvrageParReservation::class);
    }
}
