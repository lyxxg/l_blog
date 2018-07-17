<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id',"comment_id","comment","answer_id","belog"];

    function user()
    {
        return $this->belongsTo(User::class);
    }
    function question(){
        return $this->belongsTo(Question::class);
    }
    function answer(){
        return $this->belongsTo(Answer::class);
    }

    function fathercomment(){//父级id
    return $this->belongsTo(Comment::class,"comment_id");
    }


}
