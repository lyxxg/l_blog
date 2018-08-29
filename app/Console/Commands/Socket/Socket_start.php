<?php

namespace App\Console\Commands\Socket;

use Illuminate\Console\Command;

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

    }
}
