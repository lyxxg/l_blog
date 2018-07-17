<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    function objectUser(){
        return $this->belongsTo(User::class,"object_user_id");
    }

    function question(){
        return $this->hasOne(Question::class,"id","object_id");
    }

    function comment(){
        return $this->belongsTo(Comment::class,"object_id");
    }
function answer(){
        return $this->belongsTo(Answer::class,"object_id","id");
}

}
