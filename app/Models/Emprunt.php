<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;

class Emprunt extends Model
{
    use HasFactory;
    protected $fillable = ['date_emprunt', 'date_retour','id_abonne', 'id_personnel'];
    protected $primaryKey = 'id_emprunt';
    protected $casts = [
        'date_emprunt' => 'date',
        'date_retour' => 'date',
    ];


    public function etatEmprunt()
    {
        $restitution = Restitution::all()->where('id_emprunt', $this->id_emprunt)->first();
        if ($restitution == null)
        {
            return false;
        }
        return true;
    }

    public function getNombreOuvrageEmprunteAttribute()
    {
        return $this->lignesEmprunts()->count();
    }

    public function getOuvrageEmprunteAttribute()
    {
        $ouvrages = array();
        foreach ($this->lignesEmprunts as $l){
            array_push($ouvrages, $l->ouvrage->titre);
        }
        return $ouvrages;
    }

    public  function  empruntExpierAttribute(){
        return Carbon::now()->gt($this->date_retour);
    }
    public function getJourRestantAttribute(){
        $nbJour = -1;
        $nbJour = $this->date_retour->diffInDays(Carbon::now());

        if ($this->empruntExpierAttribute()){
            $nbJour = $nbJour*-1;
        }
        return $nbJour;
    }

    public function abonne()
    {
        return $this->belongsTo(Abonne::class, 'id_abonne');
    }

    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'id_personnel');
    }

    public function lignesEmprunts()
    {
        return $this->hasMany(LignesEmprunt::class, 'id_emprunt');
    }

    public function restitution()
    {
        return $this->hasOne(Restitution::class, 'id_restitution');
    }

    public static function enregistrerLignesEmprunt($datas, $emprunt)
    {
        $datas = Controller::extractLineToData($datas);
        for ($i=0; $i<count($datas)-1; $i++){
            self::enregistrerUneLignesEmprunt($datas[$i][0], $datas[$i][1], $emprunt);
        }
    }

    public static function enregistrerUneLignesEmprunt($id_ouvrage, $etat_sortie, $emprunt)
    {
        $ouvrage = Ouvrage::find($id_ouvrage);
        $ouvrage->decrementerNombreExemplaire();
        LignesEmprunt::create([
            'etat_sortie' => array_search($etat_sortie, Controller::demanderEtat()),
            'disponibilite' => false,
            'id_ouvrage' => $ouvrage->id_ouvrage,
            'id_emprunt' => $emprunt->id_emprunt,
        ]);
    }

    public function getAllLignesEmpruntByEmprunt()
    {
        $lignes_emprunt = [];
        $lignes_emprunt_by_emprunt = $this->lignesEmprunts;
        $restitution = Restitution::all()->where('id_emprunt', $this->id_emprunt)->first();

        foreach ($lignes_emprunt_by_emprunt as $ligne){

            if ($ligne->disponibilite){
                $etat_entree = LignesRestitution::all()->where('id_restitution', $restitution->id_restitution)->first()->etat_entree;
                $etat_entree =  Controller::afficherEtat($etat_entree);
            }

            $fullLine = [
                'numero_ligne' => $ligne->id_ligne_emprunt,
                'numero_emprunt' => $ligne->id_emprunt,
                'numero_ouvrage' => $ligne->id_ouvrage,
                'etat_sortie' => Controller::afficherEtat($ligne->etat_sortie),
                'etat_entree' => $etat_entree ?? "",
                'titre_ouvrage' => $ligne->ouvrage->titre,
                'cote' => $ligne->ouvrage->cote,
                'disponibilite' => $ligne->disponibilite,
            ];
            array_push($lignes_emprunt, $fullLine);
        }
        return $lignes_emprunt;
    }
}
