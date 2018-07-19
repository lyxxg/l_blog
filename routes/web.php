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



//前台
Route::group(['namespace'=>'Blog'],function () {

    //文章
    Route::resource('/', 'IndexController');
    Route::get('articleshow/{id}', 'IndexController@show');
    Route::post('/store', "IndexController@store");

    //标签
    Route::resource("tag", "TagController");

    //editor.md图片上传
    Route::post('/uploadimage', "IndexController@imageupload");

});


Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');

