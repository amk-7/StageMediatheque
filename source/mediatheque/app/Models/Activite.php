<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    use HasFactory;
    protected $fillable = ['ouvrages', 'sugestions', 'id_abonne'];
    protected $primaryKey = 'id_activite';

    public function abonne(){
        return $this->belongsTo('App\Models\Abonne', 'id_abonne');
    }
}
