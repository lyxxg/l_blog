<?php

namespace App\Http\Controllers\Blog;

use App\Facades\BlogFacade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ChatController extends Controller
{

    public function index()
    {

    $user_id=BlogFacade::getUserInfo()->user_id;

    //2是游客
    if( $user_id == 2 )
    $token='helloword';

    //得到用户token
    else
    {

    $token_data=BlogFacade::getToken();
    $u_token=$token_data['u_token'];

    \Redis::zadd('token',$user_id,$token_data['token']);
 //   \App\Models\ChatToken::create(['user_id' => $user_id, 'token' => $token]);


    }
    return view("Blog.chat.index",compact('u_token'));

    }

}
