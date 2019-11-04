<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Client extends Authenticatable
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'date_of_birth', 'blood_type_id', 'last_donation_date', 'city_id', 'phone', 'password', 'pin_code', 'is_active');

    public function notification()
    {
        return $this->belongsToMany('App\Models\Notifications');
    }

    public function donation_requests()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');
    }

    public function reports()
    {
        return $this->hasMany('App\Models\Report');
    }

    public function Contacts()
    {
        return $this->hasMany('App\Models\Contact');
    }

    public function blood_types()
    {
        return $this->belongsToMany('App\Models\BloodType');;
    }

    public function blood_type()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

    public function governorates()
    {
        return $this->belongsToMany('App\Models\Governorate');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function tokens()
    {
        return $this->hasMany('App\Token');
    }

    protected $hidden = [
        'password', 'api_token'
    ];

}
