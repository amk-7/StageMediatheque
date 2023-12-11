<?php

namespace App\Exports;

use App\Models\Ouvrage;
use Maatwebsite\Excel\Concerns\FromCollection;

class OuvragesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Ouvrage::all();
    }
}
