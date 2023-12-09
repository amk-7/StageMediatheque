<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ouvrage extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre', 'mot_cle', 'resume', 'annee_apparution', 'lieu_edition',
        'id_niveau', 'id_type', 'image', 'id_langue', 'ressources_externe',
        'isbn', 'nombre_exemplaire', 'documents', 'id_nature', 'cote'
    ];

    protected $casts = [
        'mot_cle'=>'array',
    ];

    protected $primaryKey = 'id_ouvrage';

    public function getHasDigitalVersionAttribute(){
        return $this->documents ? true : false;
    }

    public function getHasPhysicalVersionAttribute(){
        return $this->nombre_exemplaire ? true : false;;
    }

    public function getIsAvailableInLibraryAttribute(){
        if ($this->hasPhysicalVersion){
            return $this->nombre_exemplaire > 0;
        }
        return false ;
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


    public function type()
    {
        return $this->belongsTo(TypesOuvrage::class, 'id_type');
    }

    public function langue()
    {
        return $this->belongsTo(Langue::class, 'id_langue');
    }

    public function niveau()
    {
        return $this->belongsTo(Niveau::class, 'id_niveau');
    }

    public function domaines()
    {
        return $this->belongsToMany(Domaine::class, 'domaines_ouvrages','id_ouvrage', 'id_domaine');
    }

    public function nature()
    {
        return $this->belongsTo(Nature::class, 'id_nature');
    }

    public function ajouterDomaines($domaine_ids)
    {
        $this->domaines()->attach($domaine_ids);
        $this->save();
    }

    public function retirerDomaines($domaine_ids)
    {
        $this->domaines()->detach($domaine_ids);
        $this->save();
    }

    public function auteurs()
    {
        return $this->belongsToMany(Auteur::class, "auteurs_ouvrages", "id_ouvrage", "id_auteur")
                    ->withTimestamps();
    }

    public function approvisonnements()
    {
        return $this->hasMany(Approvisionnement::class, 'id_approvisionnement');
    }

    public function classificationDeweyDizaine(){
        return $this->belongsTo(ClassificationDeweyDizaine::class, "id_ouvrage_physique");
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
