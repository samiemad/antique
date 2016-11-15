<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        return $this->hasMany('App\User');
    }
    public function items(){
        return $this->hasMany('App\Item');
    }
    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function location(){
        return $this->belongsTo('App\Location');
    }
}
