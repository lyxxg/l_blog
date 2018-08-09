<?php

namespace App\Http\Controllers\Blog;

use App\Facades\BlogFacade;
use App\Models\Answer;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
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
     */
    public function store(Request $request)
    {
    $answer=new Answer();
    $answer->article_id=$request->article_id;
    $answer->user_id=Auth::id();
    $answer->content=$request->content;
    $result=$answer->save();

    if($result)
    $dataArr=BlogFacade::getJson();
    $dataArr['data']=$result;
    return $dataArr;


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    //采纳
    public function accept(Request $request)
    {

        //a_id文章id  an_id 答案id

        $dataArr=BlogFacade::getJson();
        //验证是否是本人

        $answer=Answer::find($request->an_id);
        $article=Article::find($request->a_id);
        //这是自定义的门面
        $result=BlogFacade::isMe($answer->user_id,1);
        if(!empty($result)){
            return $result;
        }

        $article->accept=$request->an_id;
        if($article->save()){
            $dataArr['code']=0;
            $dataArr['msg']='已采纳成功';
       }else{
            $dataArr['code']=1;
            $dataArr['msg']='采纳失败';
        }
        return json_encode($dataArr);



    }


}


