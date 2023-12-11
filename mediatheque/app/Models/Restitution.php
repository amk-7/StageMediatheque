<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restitution extends Model
{
    use HasFactory;
    protected $fillable = ['date_restitution', 'etat', 'id_abonne', 'id_personnel', 'id_emprunt'];
    protected $primaryKey = 'id_restitution';

    public static function etatRestitution($id_emprunt, $nb_lignes_restitution)
    {
        $emprunt = Emprunt::find($id_emprunt);
        $nb_lignes_emprunt = (integer) $emprunt->nombreOuvrageEmprunte;
        $nb_lignes_restitution = (integer) $nb_lignes_restitution;
        if ($nb_lignes_restitution < $nb_lignes_emprunt){
            return false;
        } return true;
    }

    public static function etatRestitutionUpdate($restitution)
    {
        $lignes_emprunt = LignesEmprunt::all()->where('id_emprunt', $restitution->id_emprunt);
        foreach ($lignes_emprunt as $ligne)
        {
            if (! $ligne->disponibilite)
            {
                return false;
            }
        }
        return true;
    }

    public static function restitutionsPartiel()
    {
        $restitutions = Restitution::all()->where('etat', 0);
        return $restitutions;
    }

    public function lignesRestitutions()
    {
        return $this->hasMany(LignesRestitution::class, 'id_restitution');
    }

    public function getNombreOuvragesAttribute()
    {
        return $this->lignesRestitutions()->count();
    }

    public function abonne()
    {
        return $this->belongsTo(Abonne::class, 'id_abonne');
    }

    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'id_personnel');
    }

    public function emprunt()
    {
        return $this->belongsTo(Emprunt::class, 'id_emprunt');
    }
}

