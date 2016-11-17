<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    public function follower(){
    	return $this->belongsTo('App\User');
    }
    public function followed(){
    	return $this->belongsTo('App\User');
    }
    public function notification(){
    	return $this->belongsTo('App\Notification');
    }
}
