<?php

namespace App\Http\Controllers\Blog;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $title=$request->title;
        $articles=Article::where('title','like',"%$title%")->get();
        return view("Blog.search.index",compact('articles','title'));

    }
}
