<?php

namespace App\Http\Controllers\Auth;

use App\Events\DXEvent;
use App\Http\Controllers\Controller;
use App\Listeners\DXListener;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    public function showLoginForm() {

        return view('Blog.auth.login');

    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */

    //顶象验证sdk
protected function validateLogin(Request $request) {



    $result=event(new DXEvent($request))[0];
    if(!$result){

       Session()->flush();
       dd("验证失败");
        }//顶象验证

        $this->validate($request, [
            $this->username() => 'required',
            'password' => 'required',
        ],[
            'password.required' =>'密码不能为空',
        ]);


}


    public function username()
    {
        return "name";
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



}
