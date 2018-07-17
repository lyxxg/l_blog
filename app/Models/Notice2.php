<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice2 extends Model
{
    function objectUser(){
        return $this->belongsTo(User::class,"user_id");
    }
function object_notices(){
        return $this->belongsTo(Msg::class,"object_id");
}
}
