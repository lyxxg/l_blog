<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ChatToken extends Model
{
    protected $table="chat_token";
    protected $fillable = ["user_id","token"];
    public $timestamps = false;
}
