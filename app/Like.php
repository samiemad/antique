<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function item(){
    	return $this->belongsTo('App\Item');
    }
    public function type(){
    	return $this->belongsTo('App\Liketype');
    }
}
