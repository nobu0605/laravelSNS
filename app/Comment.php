<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $fillable = ['comment','content_id','user_id'];

  public function user(){
    return $this->belongsto('App\User');
  }
  public function content(){
    return $this->belongsTo('App\Content');
  }
}
