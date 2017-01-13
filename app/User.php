<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){
        return $this->belongsToMany('App\Role');
    }
    public function referrer(){
        return $this->belongsTo('App\User');
    }
    public function referrees(){
        // TODO check if this relation is working!
        return $this->hasMany('App\User','referrer_id');
    }
    public function items(){
        return $this->hasMany('App\Item');
    }
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    public function likes(){
        return $this->hasMany('App\Like');
    }
    public function views(){
        return $this->hasMany('App\View');
    }
    public function filters(){
        return $this->hasMany('App\Filter');
    }
    public function favorites(){
        return $this->hasMany('App\Favorite');
    }
    public function followers(){
        // TODO check if this relation is working!
        return $this->hasMany('App\Follower', 'followed_id');
    }
    public function following(){
        // TODO check if this relation is working!
        return $this->hasMany('App\Follower', 'follower_id');
    }
    public function location(){
        return $this->belongsTo('App\Location');
    }

    public function hasRoles($roles){
        foreach($roles as $role){
            if($this->hasRole($role))
                return true;
        }
    }

    public function hasRole($role){
        return $this->roles()->find($role->id)!=null;
    }

    public function setBirthAttribute($value)
    {
        $this->attributes['birth'] = !empty($value) ? Carbon::parse($value) : null;
    }
}
