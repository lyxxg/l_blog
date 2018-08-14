<?php

namespace App\Http\Controllers\Blog;

use App\Facades\BlogFacade;
use App\Jobs\TopicRepled;
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
    $data=$request->all();
    $data['user_id']=Auth::id();
    $result=Answer::create($data);

    //返回处理结果数据
    if($result)
    $dataArr=BlogFacade::getJson();
    $dataArr['data']=$result;

   //这篇文章是那个用户写的
    $user_id=Article::find($request->article_id)->user_id;

   //存进通知表的数据
    $notices=array(
     'user_id'=>$user_id,
     'action'=>'answer',
     'object_id'=>$result->id,
     'object_user_id'=>$result->user_id,
     'article_id'=>'1',
     'msg'=>$result->content
     );
    //不是作者本人就加入通知
    if($user_id!=Auth::id())
    $this->dispatch(new TopicRepled($notices));



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

        $answer=Answer::find($request->an_id);
        $article=Article::find($request->a_id);

        //验证是否是本人
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


