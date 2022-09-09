<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivresPapier extends Model
{
    use HasFactory;
    protected $fillable = ['categorie', 'ISBN', 'id_ouvrage_physique'];
    protected $primaryKey = 'id_livre_papier';
    protected $casts = ['categorie' => 'array'];

    public function ouvragesPhysique(){
        return $this->belongsTo(OuvragesPhysique::class, "id_ouvrage_physique");
    }
}
