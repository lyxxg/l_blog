<?php

namespace App\Http\Controllers\Admin;

use App\Facades\BlogFacade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Focu;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;

class FocusController extends Controller
{

    //轮播图页面
    public function edit()
    {
        $focus=Focu::all();
        return view("Admin.Focus.edit",compact('focus'));

    }

     //轮播图修改
    public function update(Request $request)
    {
        $hrefs=$request->hrefs;
        $i=1;
        foreach ($request->titles as $title)
        {

            DB::table('focus')
                ->where('id',$i++)
                ->update(['title'=>$title,'href'=>$hrefs[$i-2]]);//第一次因为i++了  到这里$i=2
        }
        $count=Focu::count();
        for($i=1;$i<=$count;){
            $ico="icos"."$i";
        if ($request->$ico!=null){
        $path=BlogFacade::getImgName();
        DB::table('focus')
        ->where('id',$i++)
        ->update(['ico'=>$request->file($ico)->storeAs($path['imgpath'],$path['name']),'sico'=>$path['simg']]);
        $img=Image::make($request->file($ico))->resize(830,300);
        $re=$img->save('storage/'.$path['simg']);

            }
        }

        \Redis::del("focus");
        return redirect('admin/focusview');
    }
}
