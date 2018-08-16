<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id',"comment_id","comment","answer_id","belog"];

    //评论属于那个用户的
    function user()
    {
        return $this->belongsTo(User::class);
    }

    //评论属于那篇文章
    function article(){
        return $this->belongsTo(Article::class);
    }

    //评论属于那个答案
    function answer(){
        return $this->belongsTo(Answer::class);
    }

    //评论属于那个评论
    function fathercomment(){//父级id
    return $this->belongsTo(Comment::class,"comment_id");
    }


}
