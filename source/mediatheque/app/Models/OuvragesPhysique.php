<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OuvragesPhysique extends Model
{
    use HasFactory;
    protected $fillable = ['nombre_exemplaire', 'id_ouvrage', 'id_classification_dewey_dizaine', 'cote'];
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
        return $this->belongsTo(Ouvrage::class, "id_ouvrage");
    }

    public function approvisonnements()
    {
        return $this->hasMany(Approvisionnement::class, 'id_approvisionnement');
    }

    public function classificationDeweyDizaine(){
        return $this->belongsTo(ClassificationDeweyDizaine::class, "id_ouvrage_physique");
    }
    public function livrePapier(){
        return $this->hasOne(LivresPapier::class, "id_livre_papier");
    }
    public function documentAudioVisuel(){
        return $this->hasOne(DocumentsAudioVisuel::class, 'id_document_audio_visuel');
    }

    public function lignesRestitutions(){
        return $this->hasMany(LignesRestitution::class, 'id_ouvrage_physique');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'id_ouvrage_physique');
    }
    public function lignesEmprunts()
    {
        return $this->hasMany(LignesEmprunt::class, 'id_ouvrage_physique');
    }
}
