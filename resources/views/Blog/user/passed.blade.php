@extends("Blog.layuots.nosider")
@section("content")

    <div class="layui-container">
        <div class="layui-row">
            <div class=""  style="height: 600px">



                <form class="layui-form" action="{{ route('passtore') }}" method="post">

                            {{ csrf_field() }}


                    @if(count($errors)>0)
                            @foreach($errors->all() as $error)
                                <div class="item layui-elem-quote blog-error layui-quote-nm">
                                    {{ $error  }}
                                </div>
                            @endforeach

                    @endif


                    <div class="layui-form-item" style="margin-top: 5%">
                        <div class="layui-colla-title" style="text-align: center">
                            密码修改
                        </div>


                        <label class="layui-form-label">原密码</label>
                        <div class="layui-input-block">
                            <input type="text" name="old_password" required  lay-verify="required" placeholder="请输原来的密码" autocomplete="off" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item blog-mtop">
                        <label class="layui-form-label">新密码</label>
                        <div class="layui-input-block">
                            <input type="text" name="password" required  lay-verify="required" placeholder="请输新密码" autocomplete="off" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item blog-mtop">
                        <label class="layui-form-label">确认密码</label>
                        <div class="layui-input-block">
                            <input type="text" name="password_confirmation" required  lay-verify="required" placeholder="请确认密码" autocomplete="off" class="layui-input">
                        </div>
                    </div>

                <div class="layui-form-item" style="margin-top: 10%">
                    <div class="layui-input-block">
                        <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="formDemo">修改密码</button>
                    </div>
                </div>


                </form>

            </div>
        </div>
    </div>

@endsection
<script src="{{asset('blog/css/layui/lay/modules/layer.js')}}"></script>

<script>
    layer.msg('出bug了', {icon: 5,offset:top});
</script>