<?php

namespace App\Http\Controllers\Blog;

use App\Models\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CollectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 处理收藏ajax发送过来的请求
     */
    public function store(Request $request)
    {

        $collect=new Collection();

        $result=$collect->Where('user_id',1)->Where('article_id',$request->a_id)->get();

        $dataArr=array(
          'code'=>0,
           'data'=>'',
           'msg'=>'收藏成功'
        );

        //如果没有收藏这个文章 增加收藏
        if(empty($result->first())) {

            $collect->user_id = Auth::id();
            $collect->article_id = $request->a_id;
            if(!$collect->save()){
                $dataArr['code']=1;
                $dataArr['msg']='收藏失败';
            }
            return json_encode($dataArr);
        }


        //取消收藏
        else{

         $result=$collect->Where('user_id',1)->Where('article_id',$request->a_id)->delete();
         $dataArr['code']=2;
         $dataArr['msg']='取消收藏成功';
          if(!$result){

              $dataArr['code']=3;
              $dataArr['msg']='取消收藏失败 请联系管理员';

          }
        return json_encode($dataArr);



        }






    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $collects=Collection::Where('user_id',$id)->get();
        return view("Blog.collect.show",compact('collects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
