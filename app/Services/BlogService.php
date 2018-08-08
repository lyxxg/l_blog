<?php

namespace App\Services;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class BlogService
{




    //判断性别
    static public function getSex($may)
    {

        switch ($may)
        {
            case 0:return '<div class="layui-icon layui-icon-female blog-sex" style="color: pink"></div>';break;

            case 1:return '<div class="layui-icon layui-icon-male blog-sex" style="color: green"></div>';break;

            case 3:return '<div class="layui-icon layui-icon-help blog-sex" style="color: purple"></div>';break;

            default:return '人妖';
        }


    }




    //默认的json返回  不然在控制器写代码量会多
    static public function getJson()
    {
        $dataArr=array(
            'code'=>0,
            'data'=>'',
            'msg'=>'success'
        );
        return $dataArr;
    }







    //天天定义验证规则太麻烦 直接调用验证这个是不是本人
    /*
     *
     * id 条件
     *
     * option
     * (
     * 1. 返son格式
     * 2. 返回是本人 1 不是0
     * 3. 返回直接扔个错误页面给他)
     *
     *send 暂时没想出来
     * */
    static public function  isMe($id,$option,$send=0)
    {

        $auth_id=$this->getUserInfo()[0]->user_id;
        switch ($option)
        {
            case 1:{
                $dataArr=self::getJson();
                if($auth_id!=$id)
                {
                    $dataArr['code']=5;
                    $dataArr['msg']='你别搞事情 我跟你讲';
                    $dataArr['data']='(ノ｀Д)ノ';
                    return $dataArr;
                }

            }break;

            case 2:{

            if($auth_id==$id){
                return 1;
            }return 0;

            }break;

            case 3:{
            if(!$auth_id==$id){
               return view("errors.noisme");
            }

            }break;
        }

    }


        //获取用户个人资料
        public function getUserInfo($id=''){

        $user_key='user_'.$id;
        if(empty($id)){//此时再去数据库查询当前登录的id
            $user_key='user_'.Auth::id();
        }

        $userinfo=\Redis::get($user_key);
        $userinfo=json_decode($userinfo);

        if(empty($userinfo)){//如果redis没有获取到这个用户的信息

        $userinfo=Auth::user()->info->where('user_id',Auth::id())->select('nick','coins','sex','avatar','user_id')->get();

        \Redis::set($user_key,$userinfo);
        }
            return $userinfo[0];
        }



}