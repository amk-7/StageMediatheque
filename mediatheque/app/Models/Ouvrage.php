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
        'id_niveau', 'image', 'ressources_externe', 'id_type',
        'isbn', 'nombre_exemplaire', 'documents', 'id_nature', 'cote', 'etat'
    ];

    protected $casts = [
        'mot_cle'=>'array',
    ];

    protected $with = ['langues', 'domaines', 'auteurs', 'type', 'niveau', 'nature'];

    protected $primaryKey = 'id_ouvrage';

    public function scopeFilter($query, $filters)
    {
        // Filtre par titre, ISBN ou mot-clé
        if (isset($filters['search']) && !empty($filters['search'])) {
            $query->where(function ($query) use ($filters) {
                $query->where('titre', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('isbn', 'like', '%' . $filters['search'] . '%')
                    ->orWhereJsonContains('mot_cle', $filters['search']);
            });
        }

        // Filtre par année
        if (isset($filters['min']) && !empty($filters['min'])) {
            $query->where('annee_apparution', '>=', $filters['min']);
        }

        if (isset($filters['max']) && !empty($filters['max'])) {
            $query->where('annee_apparution', '<=', $filters['max']);
        }

        // Filtre par langue
        if (isset($filters['langue']) && !empty($filters['langue'])) {
            $query->whereHas('langues', function ($query) use ($filters) {
                $query->where('libelle', $filters['langue']);
            });
        }

        // Filtre par type
        if (isset($filters['type']) && !empty($filters['type'])) {
            $query->where('id_type', $filters['type']);
        }

        // Filtre par domaine
        if (isset($filters['domaine']) && !empty($filters['domaine'])) {
            $query->whereHas('domaines', function ($query) use ($filters) {
                $query->where('libelle', $filters['domaine']);
            });
        }

        // Filtre par niveau
        if (isset($filters['niveau']) && !empty($filters['niveau'])) {
            $query->where('id_niveau', $filters['niveau']);
        }

        return $query;
    }

    public function getAfficherMotCleAttribute(){
        $result = implode(",", $this->mot_cle);
        return $result;
    }

    public function getAfficherLangueAttribute(){
        $result = "";
        $langues = $this->langues;
        foreach ($langues as $index=>$langue) {
            if ($index < $langues->count()-1) {
                $result = $result.$langue->libelle.",";
            } else {
                $result = $result.$langue->libelle;
            }
        }

        return $result;
    }

    public function getAfficherAuteursAttribute(){
        $result = "";
        $auteurs = $this->auteurs;
        foreach ($auteurs as $index=>$auteur) {
            if ($index < $auteurs->count()-1) {
                $result = $result." ".strtoupper($auteur->nom)." ".ucfirst($auteur->prenom)." ,";
            } else {
                $result = $result.strtoupper($auteur->nom)." ".ucfirst($auteur->prenom);
            }
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
        return !($this->documents);
    }

    public function getHasPhysicalVersionAttribute(){
        return $this->nombre_exemplaire > 0 ;
    }

    public function getIsAvailableInLibraryAttribute(){
        return $this->hasPhysicalVersion && $this->nombre_exemplaire > 0;
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
