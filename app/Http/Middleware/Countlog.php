<?php

namespace App\Http\Middleware;

use App\Facades\BlogFacade;
use App\Jobs\Count;
use Closure;
use Illuminate\Support\Facades\Storage;

class Countlog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected $arr=array();
    protected $ip;
    //这里有坑 Redis incr会调用两次的
    public function __construct()
    {

    }


    protected function  countData()
    {
        $this->ip=request()->ip();

        $browser=BlogFacade::getBrowser();
        if( preg_match('#(.+)/#',$browser, $match)) {
        $browser=$match[1];
        }

        //点击量
        $res=\Redis::incr('count');
        $arr=[
            'id'=>$res,   //因为是memory   每次重启mysql都会清空表数据
            'ip'=>$this->ip,
           // 'time'=> date('m-d-h:m:s'), mysql 不需要了
            'is_mobile'=> BlogFacade::is_mobile(),
            'browser'=> $browser,
        ];

            return   $arr;

    }

    public function handle($request, Closure $next)
    {
        //坑:我算是服了文件读取json了  反序列化什么办法都不行  改用队列+Memory引擎
       // Storage::disk('log')->prepend('count.log', json_encode($this->countData()));

        //Redis hyperloglog结构  成功插入返回1  存在则不插入返回0
        $res=\Redis::pfadd("ip",$this->ip);
        if($res){
            Count::dispatch($this->countData(),BlogFacade::is_mobile());//保存用户浏览器信息
        }
        return $next($request);
    }



}
