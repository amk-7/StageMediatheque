<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Langue extends Model
{
    use HasFactory;
    protected $fillable = ['libelle'];
    protected $primaryKey = 'id_langue';

    public function ouvrages()
    {
        return $this->belongsToMany(Ouvrage::class, "langues_ouvrages", "id_ouvrage", "id_langue")
                    ->withTimestamps();
    }
}
