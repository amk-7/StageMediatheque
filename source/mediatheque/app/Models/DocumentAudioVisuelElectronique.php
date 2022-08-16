<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentAudioVisuelElectronique extends Model
{
    use HasFactory;
    protected $fillable = ['genre', 'ISAN', 'id_ouvrage_electronique'];
    protected $primaryKey = 'id_document_audio_visuel_electronique';
}
