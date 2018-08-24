<?php

namespace App\Http\Controllers\Admin;

use App\Models\TagType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagTypeController extends Controller
{
    //标签分类展示
    public function list()
    {

    $tagtypes=TagType::with('tags')->Paginate(20);
    return view("Admin.TagType.list",compact('tagtypes'));
    }

    //标签分类添加
    public function add(Request $request)
    {
    $tagtype=TagType::create($request->all());


    return redirect(url('admin/tagtype'));
    }

    public function edit(Request $request)
    {
    $tagtype=TagType::find($request->id);
    $tagtype->type_name=$request->type_name;
    $res=$tagtype->save();
    if($res)
    return 1;
    return 0;

    }


}
