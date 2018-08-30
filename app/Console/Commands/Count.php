<?php

namespace App\Console\Commands;

use App\Facades\BlogFacade;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class Count extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
   protected $signature = 'count:clear';
//    protected $signature = 'GroupName:Count {param1? } {--param2=}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '清除网站统计';

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
    public function handle()
    {

     //   $user=BlogFacade::getUserInfo();
        var_dump($user);
        //清除统计
        \Redis::del('ip');
        \Redis::del('count');
        foreach (BlogFacade::AllBrowser() as $browser)
        {
            \Redis::del($browser);
        }

    }



}
