@extends("Blog.layuots.app")
@section("content")
    <h3 class="layui-layer-title"><span class="bg-danger">{{$title}}
        </span>  {{$articles->count()}}篇文章
        <hr class="layui-bg-blue">

    </h3>

    <div class="layui-container">
        <div class="layui-row">

            <div class="layui-col-lg8">

                <div class="blog-box">
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
                                    <div id="showMD">
                        <textarea style="display:none;" name="editormd-markdown-doc">
{!!$article->content!!}</textarea>
                                    </div>
                                </div>


                                <div class="view-all layui-btn"><a href="{{url('articleshow/'.$article->id)}}">查看所有</a></div>


                            </fieldset>

                        </div>



                    @endforeach

                </div>

                </div>





        </div>
    </div>
@endsection
