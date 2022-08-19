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
        return $this->belongsToMany(OuvragePhysique::class)->using(RestitutionOuvragePhysique::class);
    }
}
