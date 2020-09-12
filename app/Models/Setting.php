<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('notification_setting_text', 'about_app','long_desc','small_desc', 'phone', 'email', 'fb_url', 'tw_url', 'youtube_url', 'insta_url');

}
