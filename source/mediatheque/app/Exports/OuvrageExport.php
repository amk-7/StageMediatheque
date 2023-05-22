<?php

namespace App\Exports;

use App\Models\Ouvrage;
use App\Service\LivresPapierService;
use Maatwebsite\Excel\Concerns\FromCollection;

class OuvrageExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $ouvrages = LivresPapierService::getAllIDLivrePapier(Ouvrage::all());
        return $ouvrages ;
    }
}
