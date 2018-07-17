<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    protected $fillable = ["user_id","follower_id","created_at","updated_at"];

    function user(){
        return $this->belongsTo(User::class);
    }

}
