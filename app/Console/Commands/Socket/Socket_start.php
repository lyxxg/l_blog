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
        \Redis::set('test111',$request->fd);

        \Redis::set('test',$request->fd);

    \Redis::sAdd('user',$request->fd);

    }



    protected function message($ws,$request)
    {

        $u_data=explode(',',$request->data);
        $msg=$u_data[0]; //用户发送过来的消息

        file_put_contents('1.txt',$msg);

        $token=decrypt($u_data[1]);//解密token
        //if(empty(\Redis::zrank('token',$token)))//如果这个token不存在
       // return "bug";
            file_put_contents('1.txt',$msg);
            $user_id=explode(':',$token)[0];
        $currUser=BlogFacade::getUserInfo($user_id);
        $arr=[
          'nick'=>$currUser->nick,
          'savatar'=>$currUser->savatar,
          'data'=>$msg,
        ];


        $data=BlogFacade::getJson();
        $data['data']=$arr;

        $users=\Redis::sMembers('user');
        foreach ($users as $user) {
        $ws->push($user,json_encode($data));

    }
    }





}
