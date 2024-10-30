<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypesOuvrage extends Model
{
    use HasFactory;

    protected $fillable = ['libelle'];
    protected $primaryKey = 'id_type_ouvrage';

    public function ouvrages()
    {
        return $this->hasMany(Ouvrage::class, 'id_type');
    }
}


