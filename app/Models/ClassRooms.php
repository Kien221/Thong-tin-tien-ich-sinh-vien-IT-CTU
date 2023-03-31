<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRooms extends Model
{
    use HasFactory;
    protected $table = 'classrooms';
    protected $fillable = [
        'category_id',
        'room_PW',
        'room_name',
        'detail_way',
    ];
    public $timestamps = false;
}
