@extends('Blog.layuots.app')
@section('content')

    <div class="blog-box">
        <form class="layui-form" role="form" method="POST" action="{{ route('register') }}">

                            {{ csrf_field() }}

        <!---顶象sdk-->
            <input type="hidden" name="DXtoken" value="" id="BlogToken">


            <div class="layui-colla-title">
注册
            </div>


            @if ($errors->has('name'))
                <div class="item layui-elem-quote blog-error layui-quote-nm">
                    {{ $errors->first('name') }}
                </div>
            @endif


            <div class="layui-form-item">
                <label class="layui-form-label">账号</label>
                <div class="layui-input-inline">
                    <input type="text" name="name"  value="{{ old('name') }}" required  lay-verify="required" placeholder="请输入账号" autocomplete="off" class="layui-input">
                </div>

                <div class="layui-form-mid layui-word-aux">
                    <a href="{{route('register')}}" class=""> 还没有账号?</a>
                </div>

            </div>



            <div class="layui-form-item">
                <label class="layui-form-label">邮箱</label>
                <div class="layui-input-inline">
                    <input type="email" name="email"  value="{{ old('email') }}" required  lay-verify="required" placeholder="请输入邮箱" autocomplete="off" class="layui-input">
                </div>

                <div class="layui-form-mid layui-word-aux">
                    <a href="javascript:0" class=""> 可用于找回密码</a>
                </div>

            </div>






            <div class="layui-form-item">
                <label class="layui-form-label">密码</label>
                <div class="layui-input-inline">
                    <input type="password" name="password" required lay-verify="required" placeholder="请输入密码" value="{{old('password')}}" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">确认密码</label>
                <div class="layui-input-inline">
                    <input type="password" name="password_confirmation" required lay-verify="required" placeholder="请确认" value="{{old('password')}}" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                </div>
            </div>





            <div class="captch">

                <div class="layui-form-item">
                    <label class="layui-form-label">验证</label>

                    <div class="layui-input-block">
                        <div id="c1" name="lmx"></div>
                    </div>

                </div>
            </div>






            <div class="layui-form-item">
                <label class="layui-form-label">选择</label>
                <div class="layui-input-block">
                    <input type="checkbox"  name="remember" id="remember" checked {{ old('remember') ? 'checked' : '' }} value="1" title="自动登录">
                </div>
            </div>



            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="formDemo">登录</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </form>

    </div>
    <input type="hidden" value="{{env('DXAppId')}}" id="dxappid">
    <script src="https://cdn.dingxiang-inc.com/ctu-group/captcha-ui/index.js"></script>
    <script>

        var DXappid=document.getElementById("dxappid").value;
        var myCaptcha = _dx.Captcha(document.getElementById('c1'), {
            appId: DXappid,   //appId,开通服务后可在控制台中“服务管理”模块获取
            success: function (token) {
                document.getElementById("BlogToken").value=token;
            }
        })

    </script>

@endsection
