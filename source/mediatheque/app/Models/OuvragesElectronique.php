<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OuvragesElectronique extends Model
{
    use HasFactory;
    protected $fillable = ['url', 'id_ouvrage'];
    protected $primaryKey = 'id_ouvrage_electronique';

    public function ouvrage(){
        return $this->hasOne(Ouvrage::class);
    }

    public function livreNumerique(){
        return $this->belongsTo(LivresNumerique::class);
    }

    public function documentAudioVisuelElectronique(){
        return $this->belongsTo(DocumentAudioVisuelElectronique::class);
    }

}
