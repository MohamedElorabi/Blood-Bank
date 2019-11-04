<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationRequest extends Model
{

    protected $table = 'donation_requests';
    public $timestamps = true;
    protected $fillable = array('patient_name', 'age', 'blood_type_id', 'bags_num', 'hospital_name', 'city_id', 'longitude', 'latituede', 'phone', 'notes', 'client_id');

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function blood_type()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notifications');
    }

}
