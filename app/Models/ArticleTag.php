<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    public $timestamps = false;
    function article(){
        return $this->belongsTo(Article::class);
    }

    function tag(){
        return $this->belongsTo(Tag::class);
}

}
