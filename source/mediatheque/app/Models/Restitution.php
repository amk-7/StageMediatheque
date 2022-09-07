<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restitution extends Model
{
    use HasFactory;
    protected $fillable = ['date_restitution', 'id_abonne', 'id_personnel'];
    protected $primaryKey = 'id_restitution';

    public function lignesRestitutions(){
        return $this->hasMany(LignesRestitution::class, 'id_ligne_restitution');
    }

    public function getAbonneFullNameAttribute()
    {
        return $this->abonne->utilisateur->nom." ".$this->abonne->utilisateur->prenom;
    }

    public function getPersonnelFullNameAttribute()
    {
        return $this->personnel->utilisateur->nom." ".$this->personnel->utilisateur->prenom;
    }

    public function getNombreOuvragesAttribute(){
        return $this->ouvragePhysiques()->count();
    }

    public function abonne(){
        return $this->belongsTo(Abonne::class, 'id_abonne');
    }

    public function personnel(){
        return $this->belongsTo(Personnel::class, 'id_personnel');
    }
}

