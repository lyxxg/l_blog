<?php

namespace App\Http\Controllers\Blog;

use App\Jobs\TopicRepled;
use App\Models\Answer;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Facades\BlogFacade;

class CommentController extends Controller
{
    //回复答案和回复评论
    public function comment(Request $request)
    {
        $data=$request->all();
        $data['user_id'] = Auth::id();
        $result=Comment::create($data);


        if($result->belog){//1评论  0回复
        $action='comment';
        $user_id=Answer::find($result->answer_id)->user_id;
        }else{
        $action='reply';
        $user_id=Comment::find($result->comment_id)->user_id;
        }
        $notices=array(
            'user_id'=>$user_id,
            'action'=>$action,
            'object_id'=>$result->comment_id,
            'object_user_id'=>$result->user_id,
            'msg'=>$result->comment
        );
        if($user_id!=Auth::id())
        $this->dispatch(new TopicRepled($notices));

        $dataArr=BlogFacade::getJson();
        $dataArr['data']=$result;

        if(!$dataArr['data']['belog']){//如果是回复
        $dataArr['data']['user']=Comment::find($request->comment_id)->user->info->nick;
        }

        return json_encode($dataArr);
        }


}
