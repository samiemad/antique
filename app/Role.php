<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users(){
    	return $this->belongsToMany('App\User');
    }

    public static function admin(){
    	return Role::find(1);
    }
}
