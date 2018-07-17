<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['tag_type_id','ico','name','baike','hot'];

    function TagType(){
        return $this->belongsTo(TagType::class);
    }

    /**
     * 属于该tag的所有问题
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    function questions(){
        return $this->belongsToMany(Question::class,'question_tags');
    }

    public $timestamps = false;
}
