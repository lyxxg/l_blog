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




Auth::routes();             //用户认证


Route::resource("test","Test\TestController");

//前台
Route::group(['namespace'=>'Blog'],function () {

    //收藏
    Route::resource("collect","CollectController");

    //历史文章
    Route::resource("history","HistoryController");


    Route::post("search","SearchController@search")
        ->name("search");

    //文章 主页
    Route::resource('/', 'IndexController');
    Route::get('articleshow/{id}', 'IndexController@show');
    Route::post('/store', "IndexController@store");

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



    //用户个人中心
    Route::resource("user","UserController");

    //用户消息详情
    Route::get("notices","UserController@notices")->name("notices")
    ->middleware('auth');

    //修改密码页面
    Route::get("passed","UserController@passed");

    //处理修改密码
    Route::post("passtore","UserController@passtore")->name('passtore');

});





Route::get('/home', 'HomeController@index')->name('home');

//后台
Route::group(['prefix'=>'admin','namespace'=>'Admin','as'=>'admin.','middleware'=>["auth"]],function () {

    Route::resource("/","IndexController");


});
