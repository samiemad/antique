<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	public $timestamps = false;

    public function item(){
    	return $this->belongsTo('App\Item');
    }
}
