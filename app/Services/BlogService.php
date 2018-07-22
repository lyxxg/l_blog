<?php

namespace App\Services;

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

}