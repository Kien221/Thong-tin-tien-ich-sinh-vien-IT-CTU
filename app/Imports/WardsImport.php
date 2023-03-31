<?php

namespace App\Imports;

use App\Models\Ward;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Districts;

class WardsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $district = Districts::where('DistrictName',$row[0])->first();
        return new Ward([
            'district_id'=>$district->id ?? NULL,
            'WardName' => $row[1],
        ]);
    }
}
