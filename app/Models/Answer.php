<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ["question_id","user_id","accept","content","good","bad"];


    function user(){
        return $this->belongsTo(User::class);
    }

    function comments(){
        return $this->hasMany(Comment::class);
    }
	
	function question(){
		return $this->hasOne(Question::class);
	
	}

}
