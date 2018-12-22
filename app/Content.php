<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
	protected $guarded = array('id');

	public static $rules = array(
        'user_id' => 'required',
        'content' => 'required',
	);

  public function user()
  {
    return $this->belongsto('App\User');
  }

  public function likes(){
    return $this->hasMany('App\Like');
  }

  public function comments(){
    return $this->hasMany('App\Comment');
  }
}
