<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivresNumerique extends Model
{
    use HasFactory;
    protected $fillable = ['categorie', 'ISBN', 'id_ouvrage_electronique'];
    protected $primaryKey = 'id_livre_numerique';

    public function ouvrageElectronique(){
        return $this->hasOne(OuvragesElectronique::class);
    }
}

