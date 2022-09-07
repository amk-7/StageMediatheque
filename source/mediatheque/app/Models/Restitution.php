<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restitution extends Model
{
    use HasFactory;
    protected $fillable = ['date_restitution', 'etat', 'id_abonne', 'id_personnel', 'id_emprunt'];
    protected $primaryKey = 'id_restitution';

    public function lignesRestitutions(){
        return $this->hasMany(LignesRestitution::class, 'id_restitution');
    }

    public function getNombreOuvragesAttribute(){
        return $this->lignesRestitutions()->count();
    }

    public function abonne(){
        return $this->belongsTo(Abonne::class, 'id_abonne');
    }

    public function personnel(){
        return $this->belongsTo(Personnel::class, 'id_personnel');
    }

    public function emprunt(){
        return $this->hasOne(Emprunt::class, 'id_emprunt');
    }
}

