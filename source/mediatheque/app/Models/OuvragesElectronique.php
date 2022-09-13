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
        return $this->belongsTo(Ouvrage::class, "id_ouvrage");
    }

    public function livreNumerique(){
        return $this->hasOne(LivresNumerique::class, 'id_livre_numerique');
    }

    public function documentAudioVisuelElectronique(){
        return $this->hasOne(DocumentAudioVisuelElectronique::class, 'id_document_audio_visuel_electronique');
    }

}
