<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Majors extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'Khoa_ID',
        'Major_Name',
    ];
    public function Khoas(){
        return $this->belongsTo('App\Models\Khoas','Khoa_ID');
    }
}
