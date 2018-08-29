<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banneduser;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function list()
    {
    $banneds=Banneduser::all();
    //被关进小黑屋的用户
    $bannedarr=[];
    foreach ($banneds as $banned){
        array_push($bannedarr,$banned->user_id);
    }

    $users = User::paginate(10);
    return view("Admin.User.list", compact('users','bannedarr'));

    }


    //关入小黑屋
    public function bannedadd($id)
    {
        $baddeduser=new Banneduser();
        $baddeduser->user_id=$id;
        $baddeduser->object_user_id=Auth::id();
        $baddeduser->save();
        return back();
    }
    //放出小黑屋
    public function bannedel($id)
    {
    Banneduser::where('user_id',$id)->delete();
    return back();
    }


}
