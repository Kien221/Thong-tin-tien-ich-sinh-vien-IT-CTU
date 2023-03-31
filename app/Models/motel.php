<?php

namespace App\Models;
use App\Models\Ward;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class motel extends Model
{
    use HasFactory;
    public $fillable = ['ward_id','MotelName','img','Address','Phone','prices','status','Description','slug','created_at'];
    public function ward(){
        return $this->hasOne(Ward::class,'id','ward_id');
    }
    
}
