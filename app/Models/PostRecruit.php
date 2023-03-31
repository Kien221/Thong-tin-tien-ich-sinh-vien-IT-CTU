<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;
class PostRecruit extends Model
{
    use HasFactory;
    public $fillable = [
        'company_name','city_id','company_address',
        'company_email','job_title','language_id','salary','logo',
        'job_description','slug'
       ,'created_at'
    ];

    public function language()
    {
       return $this->hasMany('App\Models\Language','language_id');
    }
    public function city()
    {
       return $this->hasOne(city::class,'id','city_id');
    }
    protected $casts = [
      'languege_id' => 'array',
    ];
    
}
