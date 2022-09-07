<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OuvragesPhysique extends Model
{
    use HasFactory;
    protected $fillable = ['nombre_exemplaire', 'id_ouvrage', 'id_classification_dewey_dizaine'];
    protected $primaryKey = 'id_ouvrage_physique';

    public function estDisponible()
    {
        if($this->nombre_exemplaire > 0){
            return true;
        } return false;
    }

    public function augmenterNombreExemplaire($nombre_exemplaire)
    {
        $this->nombre_exemplaire = $this->nombre_exemplaire + $nombre_exemplaire;
        $this->save();
    }

    public function decrementerNombreExemplaire()
    {
        $this->nombre_exemplaire = $this->nombre_exemplaire - 1;
        $this->save();
    }

    public function ouvrage(){
        return $this->hasOne(Ouvrage::class, "id_ouvrage");
    }

    public function approvisonnements()
    {
        return $this->hasMany(Approvisionnement::class, 'id_approvisionnement');
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

    public function lignesRestitutions(){
        return $this->hasMany(LignesRestitution::class, 'id_ligne_restitution');
    }

    public function reservation()
    {
        return $this->belongsToMany(Reservation::class)->using(OuvrageReservation::class);
    }
    public function lignesEmprunts()
    {
        return $this->hasMany(LignesEmprunt::class, 'id_livre_emprunt');
    }
}
