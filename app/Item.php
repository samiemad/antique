<?php

namespace App;

use App\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
    public function getLikedAttribute(){
        $like = $this->likes()->where('user_id',Auth::user()->id)->first();
        return $like!=null && $like->type->name=='Like';
    }
    public function getDislikedAttribute(){
        $like = $this->likes()->where('user_id',Auth::user()->id)->first();
        return $like!=null && $like->type->name=='Dislike';
    }
    public function getNumLikesAttribute(){
        return $this->likes()->where('liketype_id',1)->count();
    }
    public function getNumDislikesAttribute(){
        return $this->likes()->where('liketype_id',2)->count();
    }
}
