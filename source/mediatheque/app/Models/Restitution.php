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
        return $this->belongsToMany(OuvragesPhysique::class)->using(OuvragesParRestitution::class);
    }
}
