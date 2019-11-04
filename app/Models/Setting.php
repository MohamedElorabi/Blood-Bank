<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('logo', 'phone', 'email', 'fb_url', 'tw_url', 'yt_url', 'ins_url', 'wa_url', 'go_url','about');

}
