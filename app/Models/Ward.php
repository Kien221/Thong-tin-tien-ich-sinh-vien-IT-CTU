<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    public $fillable = ['district_id','WardName'];
    public $timestamps = false;
    public function district(){
        return $this->hasOne(Districts::class,'id','district_id');
    }
}
