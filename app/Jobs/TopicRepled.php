<?php

namespace App\Jobs;

use App\Models\Notice;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Mail;
class TopicRepled implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */




    /*
     * 看notices表的注释
     */

    protected $notices=array(),$user_id;
    public function __construct($notices)
    {
        $this->notices=$notices;
        $this->user_id=$notices['user_id'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        \Redis::incr('n_'.$this->user_id);
        Notice::create($this->notices);
    }

}
