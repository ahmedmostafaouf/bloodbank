<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{

    protected $table = 'governorates';
    public $timestamps = true;
    protected $fillable = array('name','id');

    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }
    public function clients()
    {
        return $this->hasMany('App\Models\Client');
    }

    public function clientss()
    {
        return $this->belongsToMany('App\Models\Client');
    }

}
