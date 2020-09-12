<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = array('id','title', 'contents', 'photo', 'category_id');

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }
    public function getPhotoAttribute($val){
        return ($val !== null) ? asset("assets/images/posts/".$val):"";
    }

}
