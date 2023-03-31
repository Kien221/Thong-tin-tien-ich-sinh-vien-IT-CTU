<?php

namespace App\Imports;

use App\Models\Majors;
use Maatwebsite\Excel\Concerns\ToModel;


class MajorsImport implements ToModel
{
    public function model(array $row)
    {
        return new Majors([
            'Khoa_ID' => '1',
            'Major_Name' => $row[0],
        ]);
    }
}
