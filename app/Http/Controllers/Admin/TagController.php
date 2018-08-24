<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\TagType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{

public function list()
{

  $tags=Tag::Paginate(15);
  return view("Admin.Tag.list",compact('tags'));

}

public function add(Request $request)
{

    $request->file('ico')->store('avatar');
    Tag::Create($request->all());

}

}
