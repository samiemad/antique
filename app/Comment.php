<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function item(){
    	return $this->belongsTo('App\Item');
    }
    public function parent(){
    	return $this->belongsTo('App\Comment', 'reply_id');
    }
    public function replies(){
    	return $this->hasMany('App\Comment', 'reply_id');
    }

    public function status(){
    	return $this->belongsTo('App\Status');
    }
}
