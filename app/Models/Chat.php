<?php

namespace App\Models;

use App\Facades\BlogFacade;
use Illuminate\Database\Eloquent\Model;

class Date
{


}

class Chat extends Model
{

//    public $table=BlogFacade::TableName(); //属性类型无法使用php  例如date(d)
    protected $fillable = ["user_id","token"];
    public $timestamps = false;


}
