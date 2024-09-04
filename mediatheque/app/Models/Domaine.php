<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domaine extends Model
{
    use HasFactory;

    protected $fillable = ['libelle'];
    protected $primaryKey = 'id_domaine';

    public function ouvrages()
    {
        return $this->belongsToMany(Ouvrage::class, 'domaines_ouvrages','id_ouvrage', 'id_domaine')
                ->withTimestamps();
    }
}
