<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    protected $table = 'cities';
    public $timestamps = true;
    protected $fillable = array('governorate_id','name');

    public function governorate()
    {
        return $this->belongsTo('App\Models\Governorate');
    }

    public function clients()
    {
        return $this->hasMany('App\Models\Client');
    }

    public function donationRequestes()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }
    public function clientss()
    {
        return $this->belongsToMany('App\Models\Client');
    }

}
