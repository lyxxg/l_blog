@extends("Blog.layuots.app")
@section("content")

    @include("Blog.particles.focus")
    <div class="article-list">



        @foreach($articles as $article)
        <div class="item layui-elem-quote">

            <fieldset class="layui-elem-field layui-field-title">
                <legend>hello word</legend>

                <div class="status">

                    <div class="layui-col-md8">
                        <span class="avatar"><img src="{{asset('blog/img/avatar.jpg')}}" class="layui-nav-img "></span>
                        <span class="status layui-badge">闲聊</span>
                        <span class="status layui-badge">最好</span>
                        <span class="status layui-badge">闲聊</span>
                        <span class="status layui-badge">最好</span>
                        <span class="status layui-badge">闲聊</span>
                        <span class="status layui-badge">最好</span>

                    </div>


                    <div class="layui-col-md4">
                        <i class="layui-icon layui-icon-username"></i>小小黑
                        <i class="layui-icon layui-icon-date"></i>9小时缺钱
                        浏览数:400
                    </div>

                </div>

                <div class="layui-field-box article-content">
                    标题去
                    闲聊 最好 发布于3小时前
                    sdfasf asdf ads f sadfassssssssssssss
                </div>


                <div class="view-all layui-btn">查看所有</div>


            </fieldset>

        </div>


@endforeach

    </div>

{{$articles->links()}}
@endsection("content")