<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = 'tokens';
    public $timestamps = true;
    protected $fillable = ['tokenFireBase', 'client_id', 'type'];
    public function client(){
        return $this->belongsTo('App\Models\Client');
    }

}
