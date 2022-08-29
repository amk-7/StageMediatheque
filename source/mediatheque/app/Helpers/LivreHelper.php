<?php

namespace App\Helpers;

class LivreHelper
{
    public static function getCategories(){
        $categories = [
            'français', 'anglais', 'allemand', 'physique', 'education',
            'hydrolique', 'musique et art', 'théologie', 'philosophie', 'zoologie', 'géologie', 'mathématique générale',
            'bibliographie', 'physique', 'médécine', 'comptabilité', 'droit'
        ];

        return $categories;
    }
}
