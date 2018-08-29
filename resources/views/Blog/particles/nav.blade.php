<div class="navbar">


    <ul class="layui-nav layui-bg-blue blog_nav">
        <label for="to-mune" class="to-mune">菜单</label>

        <input type="checkbox" class="to-mune " id="to-mune" style="display: none">


        <li class="layui-nav-item">
            <a href="{{url('/')}}">主页</a>
        </li>

        <li class="layui-nav-item">
            <a href="{{route('create')}}">发帖</a>
        </li>

        <li class="layui-nav-item">
            <a href="">标签</a>

            <dl class="layui-nav-child">
           @foreach($blogtags as $blogtag)
                <dd><a href="{{route('tag.show',$blogtag->id)}}">{{$blogtag->name}}</a></dd>
           @endforeach
            </dl>

        </li>

        <li class="layui-nav-item">

            {{--已登录--}}
            @if (!Auth::guest())
            <a href=""><img src="{{ Storage::url(Blog::getUserInfo()->savatar) }}" class="layui-nav-img" id="savatar">{{Blog::getUserInfo()->nick}}</a>
            <dl class="layui-nav-child">
                <dd><a href="{{route('user.show',Auth::User()->id)}}">个人中心</a></dd>
                <dd><a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">退了</a></dd>
            </dl>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

             @else
                <a href=""><img src="{{asset('blog/img/avatar.jpg')}}" class="layui-nav-img" id="savatar">我</a>
                <dl class="layui-nav-child">
                    <dd><a href="{{route('login')}}">登录</a></dd>
                    <dd><a href="{{route('register')}}">注册</a></dd>
                </dl>

            @endif

        </li>

        <li class="layui-nav-item">
            @if($count=Blog::noticeCount())
            <a href="{{route('notices')}}">消息<span class="layui-badge">{{$count}}</span></a>
            @else
             <a href="{{route('notices')}}">消息</a>
             @endif
        </li>


        <li class="layui-nav-item">
            <a href="">搜索</a>
            <dl class="layui-nav-child">
                <dd>
                    <form class="layui-form layui-form-pane" action="{{route('search')}}" method="post">
                      {{csrf_field()}}
                        <input type="search" name="title" required lay-verify="required" placeholder="随便搜点什么吧" autocomplete="off" class="layui-input" id="hacker-search"    >
                        <button class="layui-btn" style="width: 100%">搜索</button>
                    </form>
                </dd>


            </dl>
        </li>





        @if (Auth::guest())

        <li class="layui-nav-item login" >
            <a href="{{route('login')}}">登录</a>
        </li>

@endif

    </ul>

