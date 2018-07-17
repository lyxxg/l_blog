<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    function question(){
   return $this->belongsTo(Question::class);
    }

}
