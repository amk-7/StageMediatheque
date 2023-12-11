<?php

namespace App\Exports;

use App\Models\Abonne;
use Maatwebsite\Excel\Concerns\FromCollection;

class AbonneExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Abonne::all();
    }
}
