<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = array('id','title', 'contents','is_favourite', 'photo', 'category_id');
    protected $appends = ['is_favourite'];

       public function getIsFavouriteAttribute()
    {
       $favourite = auth()->guard()->check() ?request()->user()->whereHas('favorites',function ($query){
            $query->where('client_post.post_id' ,'=', $this->id);
        })->first() : null;

        if ($favourite)
        {
           return true;
      }
        return false;
    }
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
