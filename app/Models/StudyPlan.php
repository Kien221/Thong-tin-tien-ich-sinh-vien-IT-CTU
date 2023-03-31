<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyPlan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'Major_ID',
        'course_code',
        'course_name',
        'number_of_credits',
    ];
    public function major(){
        return $this->belongsTo('App\Models\Majors','Major_ID');
    }

}
