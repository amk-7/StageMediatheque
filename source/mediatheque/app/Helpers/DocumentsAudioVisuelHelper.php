<?php

namespace App\Helpers;

class DocumentsAudioVisuelHelper
{
    public static function getGenre()
    {
        $genres = [
            'aventure', 'guerre', 'histoire', "l'action"
        ];
        return $genres;
    }
}
