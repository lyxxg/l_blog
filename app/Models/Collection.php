<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    function article(){
   return $this->belongsTo(Article::class);
    }

}
