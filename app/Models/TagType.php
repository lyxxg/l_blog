<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagType extends Model
{
    protected $fillable = ['type_name','order_id'];

    public $timestamps = false;

    function Tags(){
        return $this->hasMany(Tag::class);
    }
}


