<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    use HasFactory;

    protected $fillable = ['libelle'];
    protected $primaryKey = 'id_niveau';

    public function ouvrages()
    {
        return $this->hasMany(Ouvrage::class, 'id_niveau');
    }
}
