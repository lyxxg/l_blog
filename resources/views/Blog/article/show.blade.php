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
                    <div class="layui-field-box article-content">
                        <div id="showMD">
                     <textarea style="display:none;" name="editormd-markdown-doc">
{!!$article->content!!}</textarea>
                        </div></div>

                </div>

            </fieldset>

            <hr class="layui-bg-blue">

            @if($Mdata['collect'])
            <button class="layui-btn"  id="collect">已收藏</button>
            @else
             <button class="layui-btn"  id="collect">收藏</button>
            @endif
            <input type="hidden" value="{{csrf_token()}}" id="collect_token">


            <h3 class="layui-colla-title">{{$article->answer}}回答</h3>
            <!--评论区-->

            <form class="layui-form" action="{{route('answer.store')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="article_id" value="{{$article->id}}">
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">评论一下吧</label>
                    <div class="layui-input-block">
                        <textarea  placeholder="请输入内容" class="layui-textarea" name="content"></textarea>
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="formDemo">评论</button>
                    </div>
                </div>


            </form>



            @foreach($article->answers as $answer)

                <div class="item layui-elem-quote comment">
                    <div class="layui-col-md10">
                        <span class="avatar"><img src="{{asset('blog/img/avatar.jpg')}}" class="layui-nav-img "></span>
                        <i class="layui-icon layui-icon-username"></i>{{$article->user->info->nickname}}
                        <i class="layui-icon layui-icon-date"></i>{{$article->created_at->diffForHumans()}}
                    </div>


                    <div class="layui-col-md2">

                        @if($Mdata['is'])
                        <button class="layui-btn-sm layui-btn blog-accept" value="{{$answer->id}}">采纳</button>
                        @endif
                            <button class="layui-btn-sm layui-btn"> 回复</button>

                    </div>



                    {!! $answer->content !!}
                </div>

            @endforeach

        </div>

    </div>
    <script>
        //收藏
        $("#collect").click(function () {
            var article_id={{$article->id}};
            var csrf_token=$("#collect_token").val();
            $.ajax({
                type:"POST",
                url:"{{route('collect.store')}}",
                data:{a_id:article_id,_token:csrf_token},
                datatype: "json",
                success:function(data){
                data=JSON.parse(data);


                switch (data.code) {

                    case 0:$("#collect").html('已收藏');break;

                    case 1:alert("收藏失败 请联系管理员");break;

                    case 2:$("#collect").html('收藏');break;

                    case 3:alert("取消收藏失败");break;

                }

                }   ,
                error: function(){

                }
            });

        })



    //采纳
        $(".blog-accept").click(function () {
            var article_id={{$article->id}};
            var answer_id=$(".blog-accept").val();
            var csrf_token=$("#collect_token").val();
          alert(answer_id);
            $.ajax({
                type:"POST",
                url:"{{route('collect.store')}}",
                data:{a_id:article_id,_token:csrf_token},
                datatype: "json",
                success:function(data){
                    data=JSON.parse(data);


                    switch (data.code) {

                        case 0:$("#collect").html('已收藏');break;

                        case 1:alert("收藏失败 请联系管理员");break;

                        case 2:$("#collect").html('收藏');break;

                        case 3:alert("取消收藏失败");break;

                    }

                }   ,
                error: function(){

                }
            });

        })


    </script>




@endsection
