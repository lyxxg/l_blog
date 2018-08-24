<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{

    //文章管理主页
    public function list()
    {

     $articles=Article::Where('del',0)->with('user','tags')->Paginate(20);

     return view("Admin.article.list",compact('articles'));
    }


    public function articledel($id)
    {
    $article=Article::find($id);
    $article->del=1;
    $result=$article->save();

    if($result)
    return back();
    return back()->withErrors("撤销文章".$article->title.'失败');

    }


    //回收文章列表
    public function revlist()
    {

    $articles=Article::Where('del',1)->with('user','tags')->Paginate(20);

    return view("Admin.article.revlist",compact('articles'));

    }

    //回收文章数据处理
    public function recover($id)
    {
    $article=Article::find($id);
    $article->del=0;
    $result=$article->save();

    if($result)
    return back();
    return back()->withErrors("撤销文章".$article->title.'失败');

    }


}
