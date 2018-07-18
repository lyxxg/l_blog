@extends("Blog.layuots.app")
@section("content")

    @include("Blog.particles.focus")
    <div class="article-list">



        @foreach($articles as $article)
        <div class="item layui-elem-quote">

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


                <div class="view-all layui-btn"><a href="{{route('show',$article->id)}}">查看所有</a></div>


            </fieldset>

        </div>


@endforeach

    </div>
<div class="lay"></div>
{{$articles->links()}}
@endsection("content")


