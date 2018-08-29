<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//如果要开发 请看waring.bug

Auth::routes();             //用户认证


Route::resource("test","Test\TestController");

//前台  count中间键统计站内请求
Route::group(['namespace'=>'Blog','middleware'=>'count'],function () {

    //文章收藏
    Route::resource("collect","CollectController");

    //历史文章
    Route::resource("history","HistoryController");


    //文章搜索
    Route::post("search","SearchController@search")
        ->name("search");

    //文章主页
    Route::resource('/', 'IndexController');
    Route::get('articleshow/{id}', 'IndexController@show')->name("articleshow");  //文章展示
    Route::post('/store', "IndexController@store");  //文章存储

    //标签
    Route::resource("tag", "TagController");

    //editor.md图片上传
    Route::post('/uploadimage', "IndexController@imageupload");

    //答案
    Route::resource("answer","AnswerController")->middleware(['auth']);;

    //采纳答案
    Route::post("accept","AnswerController@accept")->name("accept");

    //评论
    Route::post("comment","CommentController@comment")->name("comment");



    //用户头像上传
    Route::post("avatarup","UserController@avatarup")->name("avatarup");

    //用户个人中心
    Route::resource("user","UserController");

    //用户消息详情
    Route::get("notices","UserController@notices")->name("notices")
    ->middleware('auth');

    //修改密码页面
    Route::get("passed","UserController@passed");

    //处理修改密码
    Route::post("passtore","UserController@passtore")->name('passtore');

    //聊天室
    Route::get("chat",function (){
    return  view("Blog.chat.index");
    });

});





Route::get('/home', 'HomeController@index')->name('home');

//后台
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>["auth"]],function () {

    Route::get("/","IndexController@index")->name("主页");

    //文章主页
    Route::get("article","ArticleController@list")->name("文章");

    //文章撤销
    Route::post("articledel/{id}","ArticleController@articledel");

    //文章回收
    Route::get("revlist","ArticleController@revlist")->name("恢复文章");

    //文章回收数据处理
    Route::post("recover/{id}","ArticleController@recover");

    //标签分类
    Route::get("tagtype","TagTypeController@list")->name("标签分类");


    //添加标签分类view
    Route::get("typeview",function (){
        return view("Admin.TagType.add");
    })->name("添加分类标签");

    //添加标签分类
    Route::post("typeadd","TagTypeController@add");

    //编辑标签分类的数据处理
    Route::post("typedit","TagTypeController@edit");




    //标签
    Route::get("tag","TagController@list");

    //添加标签view
    Route::get("tagview",function (){
        return view("Admin.Tag.add");
    });

    //标签添加
    Route::post("tagadd","TagController@add");

    //编辑标签view
    Route::get("tageditview/{id}","TagController@editview")->name('编辑标签');

    Route::post("tagedit","TagController@edit");

    //用户列表
    Route::get("user","UserController@list");

    //小黑屋
    Route::post("bannedadd/{id}","UserController@bannedadd");
    Route::post("bannedel/{id}","UserController@bannedel");

    //轮播图 修改
    Route::get("focusview","FocusController@edit");

    Route::post("focus","FocusController@update");

        //Route::get("role0")

});
