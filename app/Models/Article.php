<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'last_answer_at'
    ];


    protected $fillable = ['title','descript','content','user_id'];

    /**
     * 属于该问题的所有标签
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    function tags(){
        return $this->belongsToMany(Tag::class,'article_tags')
            -> select('name');
    }

    function user(){
        return $this->belongsTo(User::class);
    }


    function answers(){
        return $this->hasMany(Answer::class);
    }

    function scopeLast($query){
        return $query->orderBy("created_at",'desc');
    }


}
