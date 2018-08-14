<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{

    protected $fillable = ["user_id","action","object_id","object_user_id","article_id","msg"];

    function objectUser(){
        return $this->belongsTo(User::class,"object_user_id");
    }

    function article(){
        return $this->hasOne(Article::class,"id","object_id");
    }

    function comment(){
        return $this->belongsTo(Comment::class,"object_id");
    }
    function answer(){
        return $this->belongsTo(Answer::class,"object_id","id");
    }

}
