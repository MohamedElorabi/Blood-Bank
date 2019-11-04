<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'desc');

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }

    public function donation_request()
    {
        return $this->belongsTo('App\Models\DonationRequest');
    }

}
