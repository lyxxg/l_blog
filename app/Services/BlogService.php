<?php

namespace App\Services;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BlogService
{


    protected  $user_id;
    public function __construct()
    {
        $this->user_id=Auth::id();
    }


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


    public $userinfo;        //获取用户个人资料

    public function getUserInfo($id=''){

    if(empty($id)){//此时再去数据库查询当前登录的id
        if(!Auth::guest())
        $id = $this->user_id;
        else
        $id=2;//2是游客
    }
    $user_key='user_'.$id;

    $userinfo=\Redis::get($user_key);
    $userinfo=json_decode($userinfo);
    if(empty($userinfo)){//如果redis没有获取到这个用户的信息

       $userinfo=User::find($id)->info()->select('nick','coins','sex','savatar','user_id')->get();
       \Redis::set($user_key,$userinfo);
    }
    return $userinfo[0];
    }



    //统计站内情况



    //用户未读总数
    public function noticeCount()
    {

    $count=\Redis::get('n_'.$this->user_id);
    if(!empty($count))
    return $count;
    return false;

    }




    //判断是否是手机
    public  function is_mobile(){
        $agent=strtolower($_SERVER['HTTP_USER_AGENT']);
        return (strpos($agent,'iphone')||strpos($agent,'android')||strpos($agent,'ipad'));
    }


    //判断用户浏览器
    public function getBrowser(){
    $flag=$_SERVER['HTTP_USER_AGENT'];
    $para=array();

    // 检查操作系统
    if(preg_match('/Windows[\d\. \w]*/',$flag, $match)) $para['os']=$match[0];

    if(preg_match('/Chrome\/[\d\.\w]*/',$flag, $match)){
        // 检查Chrome
        $para['browser']=$match[0];

    }elseif(preg_match('/Safari\/[\d\.\w]*/',$flag, $match)){
        // 检查Safari
        $para['browser']=$match[0];
    }elseif(preg_match('/MSIE [\d\.\w]*/',$flag, $match)){
        // IE
        $para['browser']=$match[0];
    }elseif(preg_match('/Opera\/[\d\.\w]*/',$flag, $match)){
        // Opera
        $para['browser']=$match[0];
    }elseif(preg_match('/Firefox\/[\d\.\w]*/',$flag, $match)){
        // Firefox
        $para['browser']=$match[0];
    }elseif(preg_match('/OmniWeb\/(v*)([^\s|;]+)/i',$flag, $match)){
        //OmniWeb
        $para['browser']=$match[2];
    }elseif(preg_match('/Netscape([\d]*)\/([^\s]+)/i',$flag, $match)){
        //Netscape
        $para['browser']=$match[2];
    }elseif(preg_match('/Lynx\/([^\s]+)/i',$flag, $match)){
        //Lynx
        $para['browser']=$match[1];
    }elseif(preg_match('/360SE/i',$flag, $match)){
        //360SE
        $para['browser']='360';
    }elseif(preg_match('/SE 2.x/i',$flag, $match)) {
        //搜狗
        $para['browser']='Sougou';
    }else{
        $para['browser']='Unknown';
    }
    return $para['browser'];
    }





    //返回getBrowser出现的浏览器
    /*
     * if($b == 'Chrome' || $b== 'Safari' || $b=='IE' || $b == 'Opera' ||
      $b == 'FireFox' || $b == 'OmniWeb' || $b == 'Netscape'||
      $b == 'Lynx' || $b == '360' || 'Sougou' || 'Unknown')

     */
    public function AllBrowser()
    {
        $arr=[
          'Chrome','Safari','IE','Opera',
           'FireFox','OmniWeb','Netscape',
           'Lynx','360','Sougou','Unknown'
        ];
        return $arr;
    }



    /*
     * 获取略缩图和图片文件路径名称
     * name 原图片名称
     * imgpath原图片路径   需要返回文件名称
     * simg略缩图路径 略缩图必返回完整路径+略缩图名称 /Storgae
    */
    protected $imgpath=array();
    public function getImgName()
    {

    $name=md5(rand(1,99999)).'.png';//图片文件名
    $sname='s'.$name;//略缩图

    $path=date('m/d');//路径
    $path='avatar/'.$path;
    $spath=$path.'/'.$sname;

    $imgpath['name']=$name;
    $imgpath['imgpath']=$path;
    $imgpath['simg']=$spath;

    return $imgpath;
    }



}