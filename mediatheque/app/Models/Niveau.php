<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    use HasFactory;

    protected $fillable = ['libelle'];
    protected $primaryKey = 'id_niveau';

    public function ouvrages2()
    {
        return $this->hasMany(Ouvrages2::class, 'id_niveau');
    }
}
