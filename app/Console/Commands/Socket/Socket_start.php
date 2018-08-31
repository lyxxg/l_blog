<?php

namespace App\Console\Commands\Socket;

use App\Facades\BlogFacade;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class Socket_start extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swoole_socket:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'start swoole_socket';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */


    //启动swoole socket聊天室
    public function handle()
    {
    $host=env('SWOOLE_SOCEKT_HOST',('127.0.0.1'));
    $port=env('SOOLE_SOCKET_PORT','666');
    $ws=new \swoole_websocket_server($host,$port);
    \Redis::zadd('token','2','helloword');
   //建立链接
    $ws->on('open',function ($ws,$request){
    $this->open($ws,$request);
    });

    //接受到消息
    $ws->on('message',function ($ws,$request){
    $this->message($ws,$request);
    });


    //用户退出
    $ws->on('close',function ($ws,$user){

    \Redis::sRem('user',$user);

    });


    $ws->start();

    }


    protected function open($ws,$request)
    {

    \Redis::sAdd('user',$request->fd);
    }



    protected function message($ws,$request)
    {

    $u_data=explode(',',$request->data);

    if(!$user_id=$this->token_check($u_data[0]))//如果验证token不通过
    return;

    $msg=$u_data[1];//用户发送过来的消息
    if($msg=='data:image/png;base64')//发送过来的是图片
    {
    $base64 = str_replace($u_data[0].',', '',$request->data);
    $base64=substr($base64, 0, -1);
    $msg=$base64;
    }

    $currUser=BlogFacade::getUserInfo($user_id);//用户信息
    $token_data=BlogFacade::getToken($user_id);
    $u_token=$token_data['u_token'];
    $token=$token_data['token'];
    \Redis::set('token_'.$user_id,$token);//重新设置token

    $arr=[
      'nick'=>$currUser->nick,
      'savatar'=>$currUser->savatar,
      'data'=>$msg,
      ];


    $data=array();
    $data=BlogFacade::getJson();
    $data['data']=$arr;

    $data=json_encode($data);
    $users=\Redis::sMembers('user');

    $tokenarr=['token'=>$u_token];
    $ws->push($request->fd,json_encode($tokenarr));//给用户发送token

    foreach ($users as $user)
    $ws->push($user,$data);

    }



    //验证成功返回用户id  失败返回false
    protected function token_check($token)//判断token是否正确
    {
        if($token=='helloword')//游客token为helloword
        return 2;
        $token=decrypt($token); //解密token
        $user_id=explode(':',$token)[0];//返回用户id
        file_put_contents('1.txt',$token);
        if($token==\Redis::get('token_'.$user_id))
        return $user_id;
        return false;
    }



    protected function ChatSave($arr)//保存聊天记录
    {
    
    }
}
