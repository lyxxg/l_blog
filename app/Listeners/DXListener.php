<?php

namespace App\Listeners;

use App\Events\DXEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DXListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DXEvent  $event
     * @return void
     */
    public function handle(DXEvent $event) {

        $appId = env('DXAppId');
        $appSecret = env('DXAppSecret');

        $client = new \CaptchaClient($appId, $appSecret);
        $client->setTimeOut(2);//超时
        $response = $client->verifyToken($_POST['DXtoken']);//从顶象获取管理的token
        if ($response->result)//返回验证结果
            return 1;
            return 0;

    }

}
