<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    //
   protected $fillable=[
        'title', 'body', 'start_date', 'end_date'
   ];

   public function comments(){
      return $this->hasMany('App\comment');
   }
}
