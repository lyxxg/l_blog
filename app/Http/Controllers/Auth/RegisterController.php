<?php

namespace App\Http\Controllers\Auth;

use App\Events\DXEvent;
use App\Models\UserInfo;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation1 By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('guest');

    }
    public function showRegistrationForm()
    {
        return view('Blog.auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

public function register(Request $request)
{
    if(!event(new DXEvent($request))[0])//顶象验证
    return back()->withErrors("验证失败");

    event(new Registered($user = $this->create($request->all())));//创建用户
    event(new Registered($userinfo = $this->createinfo($user->id)));//创建用户信息表


    if($request->remember){
        $this->guard()->login($user);
     }//自动登录

    return $this->registered($request, $user)
            ?: redirect($this->redirectPath());


}


    protected function validator(array $data)
    {

        dd($data->all());
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function createinfo($user_id)
    {

        return UserInfo::create([
            'user_id'=>$user_id,
            'avatar'=>'defaultico/default.png',
            'savatar'=>'defaultico/default.png',
            'nick'=>'哈哈哈',
            'coins'=>60,
            'descript'=>'这个人很帅，暂时找不到词语形容自己',
            'sex'=>3,
        ]);
    }


}
