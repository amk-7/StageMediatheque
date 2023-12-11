<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ouvrage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'titre', 'mot_cle', 'resume', 'annee_apparution', 'lieu_edition',
        'id_niveau', 'image', 'ressources_externe',
        'isbn', 'nombre_exemplaire', 'documents', 'id_nature', 'cote'
    ];

    protected $casts = [
        'mot_cle'=>'array',
    ];

    protected $primaryKey = 'id_ouvrage';

    public function getAfficherLangueAttribute(){
        $result = "";
        foreach ($this->langues as $langue) {
            $result = $result.$langue->libelle.";";
        }

        return $result;
    }

    public function getAfficherDomaineAttribute(){
        $result = "";
        foreach ($this->domaines as $domaine) {
            $result = $result.$domaine->libelle.";";
        }

        return $result;
    }

    public function ajouterLangues($langues_id)
    {
        $this->langues()->attach($langues_id);
    }

    public function retirerLangues()
    {
        $this->langues()->detach();
    }

    public function ajouterDomaines($domaines_id)
    {
        $this->domaines()->attach($domaines_id);
    }

    public function retirerDomaines()
    {
        $this->domaines()->detach();
    }

    public function ajouterAuteurs($auteurs)
    {
        foreach ($auteurs as $auteur){
            $this->auteurs()->attach($auteur->id_auteur);
        }
    }

    public function retirerAuteurs()
    {
        $this->auteurs()->detach();
    }

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

    public function langues()
    {
        return $this->belongsToMany(Langue::class, "langues_ouvrages", "id_langue", "id_ouvrage")
                    ->withTimestamps();
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
