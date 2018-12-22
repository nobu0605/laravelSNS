<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password','image',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function likes(){
      return $this->hasMany('App\Like');
    }

    public function contents(){
      return $this->hasMany('App\Content');
    }
}
