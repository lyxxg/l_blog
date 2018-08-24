<?php

namespace App\Http\Controllers\Admin;

use App\Facades\BlogFacade;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{


    //移动端和桌面端使用率
    protected function is_mobile()
    {
        //用@原因考虑 如:1/0
        @$mobile=\Redis::get("mobile")/(\Redis::get("desktop")+\Redis::get("mobile"));
        @$desktop=\Redis::get("desktop")/(\Redis::get("desktop")+\Redis::get("mobile"));
        $mobile=round($mobile,2)*100;
        $desktop=round($desktop,2)*100;
        $desktop=100-$mobile;
        $values=[
            $mobile,$desktop
        ];
        return json_encode($values);
    }


    //浏览器使用百分比  例如:Chorm=>20  Chorm使用率20%
    /*
     返回值的百分比  因为chart插件的原因
    */
    protected function browser()
    {

        $values=array();
        $arr=array();//用来返回浏览器所占的百分比
        $allBrowser=BlogFacade::AllBrowser();
        $sum=0;  //总数
        foreach ($allBrowser as $browser){//分别求出所有浏览器的次数
            $value=\Redis::get($browser);
            $arr[$browser]=$value;
            $sum+=$value;
        }

        foreach ($allBrowser as $browser)//算出百分比而已
        {
            @$arr[$browser]=round($arr[$browser]/$sum,2)*100;
            @array_push($values,$arr[$browser]);
        }
        return $values;
    }


    public function index()
    {
        $AllBrowser=json_encode($this->browser());
        //  $str=Storage::disk('log')->get('count.log');
        $IpCount=\Redis::pfcount('ip');
        $UserCount=User::count();
        $ArticleCount=Article::count();
        $mobile=$this->is_mobile();
        //dd($mobile);
        return view("Admin.index",compact('UserCount','ArticleCount','IpCount','AllBrowser','mobile'));
    }
}
