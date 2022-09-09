<?php

namespace App\Imports;

use App\Models\LivresPapier;
use Maatwebsite\Excel\Concerns\ToModel;

class LivresPapierImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        dd($row);
        return new LivresPapier([
            //
        ]);
    }
}
