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
        return $this->hasOne(Ouvrage::class, "id_ouvrage");
    }
    public function classificationDeweyDizaine(){
        return $this->belongsTo(ClassificationDeweyDizaine::class, "id_ouvrage_physique");
    }
    public function livrePapier(){
        return $this->belongsTo(LivrePapier::class, "id_livre_papier");
    }
    public function documentAudioVisuel(){
        return $this->belongsTo(DocumentsAudioVisuel::class);
    }

    public function restitution(){
        return $this->belongsToMany(Restitution::class)->using(RestitutionOuvragePhysique::class);
    }
    public function emprunt()
    {
        return $this->belongsToMany(Emprunt::class)->using(OuvrageEmprunt::class);
    }
    public function reservation()
    {
        return $this->belongsToMany(Reservation::class)->using(OuvrageReservation::class);
    }
}
