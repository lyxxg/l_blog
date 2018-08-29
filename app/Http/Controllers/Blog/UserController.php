<?php

namespace App\Http\Controllers\Blog;

use App\Facades\BlogFacade;
use App\Http\Requests\Blog\PassUpdate;
use App\Http\Requests\Blog\UserUpdate;
use App\Models\Notice;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Mockery\Generator\StringManipulation\Pass\Pass;
use function Sodium\compare;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        return view("Blog.user.show",compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

    return view("Blog.user.edit",compact('user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdate $request, $id)
    {


    $user_id=Auth::id();

    $sex=$request->sex;
    $description=$request->desc;

    UserInfo::where('user_id',$user_id)
    ->update(['sex'=>$sex,'nick'=>$request->nick,'description'=>$description]);

    if(!empty($request->file('avatar'))) {//如果头像不为空
    UserInfo::where('user_id',$user_id)
    ->update(['avatar'=>$request->file('avatar')->store('avatar')]);
    }

    return redirect()-> route('user.show',$user_id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //用户消息详情
    public function notices()
    {

    $user_id=Auth::id();
    \Redis::del('n_'.$user_id);//清楚用户的消息总数

    $notices=Notice::with('article','comment','answer')->Where("user_id",$user_id)
    ->orderByDesc('created_at')->get();
    return view("Blog.user.notices",compact('notices'));

    }


    //修改密码
    public function  passed(){

    return view("Blog.user.passed");
    }


    //处理密码
    public  function passtore(PassUpdate $request)
    {
    $user=Auth::user();
    if(!Hash::check($request->old_password,$user->password)){
        return back()->withErrors('原密码错误');
    }
    $user->password = bcrypt($request->password);
    $user->save();
    $request->session()->regenerate();
    return redirect()-> route('user.show',$user->id);

    }



    public function avatarup(Request $request)
    {


    $user_id=Auth::id();
    $path=BlogFacade::getImgName();
    $result= UserInfo::where('user_id',$user_id)
    ->update(['avatar'=>$imgurl=$request->file('savatar')->storeAs($path['imgpath'],$path['name']),'savatar'=>$path['simg']]);

    if($result){//保存略缩图
    $img=Image::make($request->file('savatar'))->resize(60,60);
    $re=$img->save('storage/'.$path['simg']);
    }
    \Redis::del("user_".$user_id);

    //返回头像和略缩头像地址
    $avatar=[
        'avatar'=>Storage::url($imgurl),
        'savatar'=>$path['simg']//
    ];

    $dataArr=BlogFacade::getJson();
    $dataArr['data']=$avatar;
    return json_encode($dataArr);

    }






}
