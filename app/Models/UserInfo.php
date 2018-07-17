<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    //
    protected $fillable=['user_id','nick','avatar','coins','description','sex','created_at','update_id'];
}
