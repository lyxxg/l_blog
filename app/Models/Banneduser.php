<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banneduser extends Model
{
    function user(){
        return $this->belongsTo(User::class);
    }
}
