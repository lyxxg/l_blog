<?php

namespace App\Http\Controllers\Blog;

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
        if($result){
        $dataArr=BlogFacade::getJson();
        $dataArr['data']=$result;

        return json_encode($dataArr);
        }

    }
}
