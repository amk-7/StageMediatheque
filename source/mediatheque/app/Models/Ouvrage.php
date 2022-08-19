<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ouvrage extends Model
{
    use HasFactory;
    protected $fillable = ['niveau', 'type', 'image', 'langue'];
    protected $primaryKey = 'id_ouvrage';


    public function OuvragePhysique(){
        return $this->belongsTo(OuvragesPhysique::class);
    }
    public function OuvrageElectronique(){
        return $this->belongsTo(OuvrageElectronique::class);
    }

    public function auteur()
    {
        return $this->belongsToMany(Auteur::class)->using(AuteurOuvrage::class);
    }

}
