<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    //
    protected $fillable=[
        'comment_body', 'task_id'
    ];

    public function task(){
            return $this->belongsTo('App\task');
        
    }
}
