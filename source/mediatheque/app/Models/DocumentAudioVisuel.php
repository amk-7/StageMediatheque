<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentAudioVisuel extends Model
{
    use HasFactory;
    protected $fillable = ['genre', 'ISAN', 'id_ouvrage_physique'];
    protected $primaryKey = 'id_document_audio_visuel';

    public function ouvragePhysique(){
        return $this->hasOne(OuvragePhysique::class);
    }
}
