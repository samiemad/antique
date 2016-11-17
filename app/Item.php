<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function category(){
    	return $this->belongsTo('App\Category');
    }
    public function location(){
    	return $this->belongsTo('App\Location');
    }
    public function status(){
    	return $this->belongsTo('App\Status');
    }

    public function comments(){
    	return $this->hasMany('App\Comment');
    }

    public function images(){
        return $this->hasMany('App\Image');
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }

    public function views(){
        return $this->hasMany('App\View');
    }

    public function favorites(){
        return $this->hasMany('App\Favorite');
    }
}
