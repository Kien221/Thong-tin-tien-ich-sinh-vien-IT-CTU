<?php

namespace App\Imports;
use Illuminate\Http\Request;
use App\Models\StudyPlan;
use App\Models\Majors;
use Maatwebsite\Excel\Concerns\ToModel;

class StudyPlanImport implements ToModel
{
    protected $major_id;
    public function  __construct($major_id)
    {
        $this->major_id= $major_id;
    }
    public function model(array $row)
    {   
        return new StudyPlan([
            'Major_ID' => $this->major_id,
            'course_code' => $row[0],
            'course_name' => $row[1],
            'number_of_credits' => $row[2],
        ]);
    }
}
