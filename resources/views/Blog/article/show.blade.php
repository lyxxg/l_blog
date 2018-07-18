@extends("Blog.layuots.app")
@section("content")
    <div class="article-list">

        <div class="item layui-elem-quote  layui-quote-nm article-show">

            <fieldset class="layui-elem-field layui-field-title">
                <legend>{{$article->title}}</legend>

                <div class="status">

                    <div class="layui-col-md8">
                        <span class="avatar"><img src="{{asset('blog/img/avatar.jpg')}}" class="layui-nav-img "></span>

                        @foreach($article->tags as $tag)
                            <span class="status layui-badge">{{$tag->name}}</span>
                        @endforeach

                    </div>


                    <div class="layui-col-md4">
                        <i class="layui-icon layui-icon-username"></i>{{$article->user->info->nickname}}
                        <i class="layui-icon layui-icon-date"></i>{{$article->created_at->diffForHumans()}}
                        浏览数:{{$article->view}}
                    </div>

                </div>


                <div class="layui-field-box article-content">
                    {!!$article->content!!}
                </div>

            </fieldset>
            <hr class="layui-bg-blue">
            <h3 class="layui-colla-title">{{$article->answer}}回答</h3>
        </div>
        <!--评论区-->
        <div class="comment">

        </div>box


    </div>
@endsection