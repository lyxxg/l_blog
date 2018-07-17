<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Msg extends Model
{
    Msg->
    function user(){
        return $this->belongsTo(User::class);
    }


}
