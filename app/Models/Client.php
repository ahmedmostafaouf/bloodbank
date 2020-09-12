<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Client extends Authenticatable  implements JWTSubject
{
    use Notifiable;
    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = ['id','phone','status', 'password', 'email', 'name', 'dop', 'blood_type_id', 'last_donation_date', 'pin_code', 'city_id','governorate_id'];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function bloodType()
    {
        return $this->belongsTo('App\Models\BloodType');
    }
    public function tokens()
    {
        return $this->hasMany('App\Models\Token');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }
    public function governorate()
    {
        return $this->belongsTo('App\Models\Governorate');
    }

    public function favorites(){
        return $this->belongsToMany('App\Models\Post');
    }

    public function donationRequestes()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification');
    }

    public function bloodTypes()
    {
        return $this->belongsToMany('App\Models\BloodType');
    }

    public function governorates()
    {
        return $this->belongsToMany('App\Models\Governorate');
    }
    public function cities()
    {
        return $this->belongsToMany('App\Models\City');
    }
   public function getStatus(){
        return $this->status==1?'مفعل':'غير مفعل';
   }






}
