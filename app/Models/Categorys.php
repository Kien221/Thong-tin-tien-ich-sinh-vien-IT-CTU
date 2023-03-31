<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorys extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'CategoryName',
    ];
    public function posts(){
        return $this->hasMany(Posts::class,'category_id','id');
    }
}
