<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Categorys;

class Posts extends Model
{
    use HasFactory;
    public $fillable = [
        'id',
        'category_id',
        'title',
        'image',
        'description',
        'file',
        'slug',
    ];
    public function category(){
        return $this->hasOne(Categorys::class,'id','category_id');
    }
    public function formatCreatedAt(){
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }
}
