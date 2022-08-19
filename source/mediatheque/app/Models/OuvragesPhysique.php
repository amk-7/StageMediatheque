<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OuvragesPhysique extends Model
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
<<<<<<< HEAD:source/mediatheque/app/Models/OuvragePhysique.php
        return $this->belongsToMany(Restitution::class)->using(RestitutionOuvragePhysique::class);
    }    
=======
        return $this->belongsToMany(Restitution::class)->using(OuvragesParRestitution::class);
    }
>>>>>>> 2b7acce2c9bebd6c0d1c218e13fd1151a5add263:source/mediatheque/app/Models/OuvragesPhysique.php
    public function emprunt()
    {
        return $this->belongsToMany(Emprunt::class)->using(OuvrageEmprunt::class);
    }
    public function reservation()
    {
        return $this->belongsToMany(Reservation::class)->using(OuvrageReservation::class);
    }
}
