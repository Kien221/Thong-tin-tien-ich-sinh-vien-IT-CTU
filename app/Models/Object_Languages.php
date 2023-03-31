<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Object_Languages extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $fillable = ['post_recruit_id','language_id'];
}
