<?php

namespace App\Http\Controllers\Admin;

use App\Facades\BlogFacade;
use App\Models\Tag;
use App\Models\TagType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{

//标签列表
public function list()
{

  $tags=Tag::Paginate(15);
  return view("Admin.Tag.list",compact('tags'));

}


//保存标签
public function add(Request $request)
{

  $path=BlogFacade::getImgName();
  $pathend=$request->file('ico')->storeAs($path['imgpath'],$path['name']);

  $data=$request->all();
  $data['ico']=$pathend;

  $res=Tag::Create($data);
  if($res)
  return redirect(url('admin/tag'));
  return back()->withErrors('保存标签出现错误 error');

}


public function editview($id)
{

   $tag=Tag::find($id);

    return view("Admin.Tag.edit",compact('tag'));
}

public function edit(Request $request)
{
  $ico=$request->file('ico');
  if(!empty($ico))
  $res=Tag::where('id',$request->id)
  ->update(['name'=>$request->name,'baike'=>$request->baike,
  'tag_type_id'=>$request->tag_type_id,'ico'=>$ico->store('tag')]);

  else
  $res=Tag::where('id',$request->id)
  ->update(['name'=>$request->name,'baike'=>$request->baike,
 'tag_type_id'=>$request->tag_type_id]);

  if($res)
  return redirect(url('admin/tag'));
  else
  return back()->withErrors('保存标签出现错误 error');

}

}
