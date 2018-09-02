<?php

namespace App\Http\Controllers\Blog;

use App\Facades\BlogFacade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class ChatController extends Controller
{

    public function index()
    {

    $tableName = 'chat_' . date('d');
    $this->in_table($tableName);

    $chats=DB::table($tableName)->take(10)->get();


    $user_id=BlogFacade::getUserInfo()->user_id;

    //2是游客
    if( $user_id == 2 )
    $u_token='helloword';

    //得到用户token
    else
    {

    $token_data=BlogFacade::getToken();
    $u_token=$token_data['u_token'];
    \Redis::set('token_'.$user_id,$token_data['token']);
    //\Redis::zadd('token',$user_id,$token_data['token']);
 //   \App\Models\ChatToken::create(['user_id' => $user_id, 'token' => $token]);
    }
    return view("Blog.chat.index",compact('u_token','chats'));

    }


    //今日表存在则通过   负责创建
    protected function in_table($tableName)
    {
    if (Schema::hasTable($tableName))
    return;

    Schema::create($tableName,function (Blueprint $table){
        $table->unsignedBigInteger('user_id')->comment("消息属于用户");
        $table->string('nick',25)->comment("用户昵称");
        $table->string('savatar')->comment("用户略缩图");
        $table->binary('data')->comment("消息");
        $table->unsignedBigInteger('time')->default(time())->comment("发送的时间戳");
    });

    }


}
