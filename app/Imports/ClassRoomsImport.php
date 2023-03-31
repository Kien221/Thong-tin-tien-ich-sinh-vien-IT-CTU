<?php

namespace App\Imports;

use App\Models\ClassRooms;
use Maatwebsite\Excel\Concerns\ToModel;

class ClassRoomsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ClassRooms([
            'room_PW' => $row[0],
            'room_name' => $row[1],
            'detail_way' => $row[2],
        ]);
    }
}
