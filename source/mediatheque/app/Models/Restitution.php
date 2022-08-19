<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restitution extends Model
{
    use HasFactory;
    protected $fillable = ['date_restitution', 'id_abonne'];
    protected $primaryKey = 'id_restitution';

    public function OuvragePhysique(){
<<<<<<< HEAD
        return $this->belongsToMany(OuvragePhysique::class)->using(RestitutionOuvragePhysique::class);
=======
        return $this->belongsToMany(OuvragesPhysique::class)->using(OuvragesParRestitution::class);
>>>>>>> 2b7acce2c9bebd6c0d1c218e13fd1151a5add263
    }
}
