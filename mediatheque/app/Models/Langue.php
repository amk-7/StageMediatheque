<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Langue extends Model
{
    use HasFactory;
    protected $fillable = ['libelle'];
    protected $primaryKey = 'id_langue';
    public function ouvrages2()
    {
        return $this->hasMany(Ouvrages2::class, 'id_langue');
    }
}
