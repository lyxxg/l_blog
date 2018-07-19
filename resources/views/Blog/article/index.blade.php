
<link href="{{asset('Editor/css/editormd.css')}}" rel="stylesheet" />
<script src="{{asset('js/jquery.js')}}" type="text/javascript"></script>
<script src="{{asset('Editor/lib/marked.min.js')}}"></script>
<script src="{{asset('Editor/lib/prettify.min.js')}}"></script>
<script src="{{asset('Editor/lib/raphael.min.js')}}"></script>
<script src="{{asset('Editor/lib/underscore.min.js')}}"></script>
<script src="{{asset('Editor/lib/sequence-diagram.min.js')}}"></script>
<script src="{{asset('Editor/lib/flowchart.min.js')}}"></script>
<script src="{{asset('Editor/lib/jquery.flowchart.min.js')}}"></script>
<script src="{{asset('Editor/editormd.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var wordsView;
        wordsView = editormd.markdownToHTML("showMD", {
            htmlDecode: false,  // you can filter tags decode
            emoji: true,
            taskList: true
        });
    })
</script>
<!--editor.md展示需要引入的  真tm多。。-->

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
<div class="lay"></div>
{{$articles->links()}}
@endsection("content")

