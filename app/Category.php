<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function parent(){
    	return $this->belongsTo('App\Category');
    }
    public function children(){
    	return $this->HasMany('App\Category');
    }
    public function items(){
        return $this->hasMany('App\Item');
    }
}
