<?php

namespace App\Jobs;

use App\Facades\BlogFacade;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class Count implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $arrData=array(),$is_mobile;
    public function __construct($arrData,$is_mobile)
    {
        $this->arrData=$arrData;
        $this->is_mobile=$is_mobile;
    }

    /**
     * Execute the job.
     *
     * @return void
     */

    public function handle()
    {
        if($this->arrData['ip'])
//        $count=new \App\Models\Count();
        $res=\App\Models\Count::create($this->arrData);//加入统计表
        $this->browser($res['browser']);

    }


    /*
         Chrome Safari IE Opera Firefox OmniWeb Netscape
         Lynx 360SE Sougou  Unknown
         */

    protected function browser($b)
    {

         if($this->is_mobile)//判断是否移动端
         { \Redis::incr("mobile");}
          else
          {\Redis::incr("desktop");}              ;

         if(!in_array($b,BlogFacade::AllBrowser())){
              $b='Unknown';
          }
          \Redis::incr($b);

    }

}
