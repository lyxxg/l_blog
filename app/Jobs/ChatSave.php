<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChatSave implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $data=array();
    public function __construct($data)
    {
        $this->data=$data;
        Log::info('ok1');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    //保存聊天记录  按日期分表  每天一个表
    public function handle()
    {
    $tableName = 'chat_' . date('d');

    $this->install_Data($this->data,$tableName);

    }

    protected function install_Data($data,$tableName)//插入数据
    {

    DB::table($tableName)->insert(
        ['user_id'=>$data['user_id'],'nick'=>$data['nick'],
         'savatar'=>$data['savatar'],'data'=>$data['data'],
         'time'=>time()
        ]
    );

    }



}
