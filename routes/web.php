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

    //用户个人中心
    Route::resource("user","UserController");



    //editor.md图片上传
    Route::post('/uploadimage', "IndexController@imageupload");


    //答案
    Route::resource("answer","AnswerController")->middleware(['auth']);;

     //采纳答案
    Route::post("accept","AnswerController@accept")->name("accept");

    Route::post("comment","CommentController@comment")->name("comment");
});


Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');

