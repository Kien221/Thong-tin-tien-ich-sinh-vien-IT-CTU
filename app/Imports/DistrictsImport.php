<?php

namespace App\Imports;

use App\Models\Districts;
use Maatwebsite\Excel\Concerns\ToModel;

class DistrictsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Districts([
            'DistrictName' => $row[1],
        ]);
    }
}
