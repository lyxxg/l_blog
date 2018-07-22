<?php

//调用此类识别性别 总是写if else 太麻烦了
class Sex
{
    protected $may;
    function sex($may)
    {
        switch ($may)
        {
            case 0:return '女';break;

            case 1:return '男';break;

            case 3:return '保密';break;

            default:return '人妖';
        }
    }


}