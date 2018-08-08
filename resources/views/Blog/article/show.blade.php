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
                        <i class="layui-icon layui-icon-username"></i>{{Blog::getUserInfo($article->user_id)->nick}}
                        <i class="layui-icon layui-icon-date"></i>{{$article->created_at->diffForHumans()}}
                        浏览数:{{$article->view}}
                    </div>

                </div>


                <div class="layui-field-box article-content">
                    <div class="layui-field-box article-content">
                        <div id="showMD">
                     <textarea style="display:none;" name="editormd-markdown-doc">{!!$article->content!!}</textarea>
                     </div>
                    </div>
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
                        <button class="layui-btn" lay-submit lay-filter="formDemo">回答</button>
                    </div>
                </div>


            </form>



            @foreach($answers as $answer)

                <div class="item layui-elem-quote comment" id="comment{{$answer->id}}">
                    <div class="layui-col-md10">
                        <span class="avatar"><img src="{{asset('blog/img/avatar.jpg')}}" class="layui-nav-img "></span>
                        <i class="layui-icon layui-icon-username"></i>{{Blog::getUserInfo($answer->usre_id)->nick}}
                        <i class="layui-icon layui-icon-date"></i>{{$article->created_at->diffForHumans()}}
                    </div>


                    <div class="layui-col-md2">

                        @if($article->accept!=$answer->id)
                        @if($Mdata['is'])
                            @if($article->accept==0)
                         <button class="layui-btn-sm layui-btn accept-btn" value="{{$answer->id}}"
                                data-article-id="{{$article->id}}" data-answer-id="{{$answer->id}}"
                    data-id="answer{{$answer->id}}"  id="answer{{$answer->id}}"  onclick="accept(this)">采纳</button>
                         @endif
                         @endif

                            @else

                            <button class="layui-btn-sm layui-btn accept-btn" value="{{$answer->id}}"
                                    data-article-id="{{$article->id}}" data-answer-id="{{$answer->id}}"
                                    data-id="answer{{$answer->id}}"  id="answer{{$answer->id}}"  onclick="accept(this)">已采纳</button>

                        @endif



                            <button class="layui-btn-sm layui-btn "  onclick="answer_reply(this)" data-answer-id="{{$answer->id}}" data-answer-id={{$answer->id}} data-typearticle="comment"  data-belog="1"> 评论</button>

                    </div>



                    {!! $answer->content !!}

                    {{--回复答案--}}
                    @foreach($answer->comments as $comment)
                        <hr/><hr/>
                        <div class="item">
                            <div class="layui-col-md10">
                                <span class="avatar"><img src="{{asset('blog/img/avatar.jpg')}}" class="layui-nav-img "></span>
                                <i class="layui-icon layui-icon-username"></i>
                                {{Blog::getUserInfo($comment->user_id)->nick}}
                                <i class="layui-icon layui-icon-date"></i>{{$comment->created_at->diffForHumans()}}
                            </div>


                            <div class="layui-col-md2">


                                <button class="layui-btn-sm layui-btn "  onclick="answer_reply(this)" data-answer-id="{{$answer->id}}"  data-comment-id="{{$comment->id}}" data-answer-id={{$answer->id}} data-typearticle="comment"  data-belog="0"> 回复</button>

                            </div>
                            @if($comment->belog==1)
                            {!! $comment->comment !!}
                            @else
                            {!!"<span style='color:green'>回复</span>"!!}
                                {{Blog::getUserInfo($comment->fathercomment->user_id)->nick}}:

                            {!!$comment->comment!!}


                            @endif
                        </div>


                    @endforeach

                </div>




                @endforeach


        </div>




    </div>
    <input type="hidden" value="{{Blog::getUserInfo(Auth::id())->nick}}" id="nickname">
    <script src="{{asset('blog/css/layui/lay/modules/layer.js')}}"></script>

    <script>
        var csrf_token=$("#collect_token").val();
        nickname=$("#nickname").val();
        function answer_reply(obj)
        {

        var belog = $(obj).attr("data-belog");
        var answer_id = $(obj).attr("data-answer-id");
        var comment_id = $(obj).attr("data-comment-id") ? $(obj).attr("data-comment-id") : 0;
        var typearticle = $(obj).attr("data-typearticle");

        //兼容手机端设置
        var w = document.documentElement.scrollWidth || document.body.scrollWidth;
        if (w >= 600) {
            layerw = 800 + "px";
            layerh = 500 + "px";
        } else {
            layerw = 300 + "px";
            layerh = 200 + "px";
        }

        layer.prompt({
            offset: ['10px', '80px'],
            formType: 2,
            title: '回复',
            area: [layerw, layerh] //自定义文本域宽高
        }, function (value, index, elem) {
            $.ajax({
                type:"POST",
                url:"{{route('comment')}}",
                data:{'belog':belog,'answer_id':answer_id,'comment_id':comment_id,'typearticle':typearticle,'comment':value,_token:csrf_token},
                datatype: "json",
                success:function(data){
                    data=JSON.parse(data);

                    switch (data.code) {

                    case 0:{
                        var replyhtml='';
                        //alert(typeof (data.data.belog));   string类型
                        data.data.belog=parseInt(data.data.belog);
                        if(!data.data.belog){//回复
                        replyhtml+='<span style="color:green">回复</span>'+data.data.user+':';
                        }
                        var html='';
                        html+=
                            '<hr/><hr/>'
                            +'<div class="item">'
                            +'<div class="layui-col-md10">'+
                            '<span class="avatar"><img src="{{asset('blog/img/avatar.jpg')}}" class="layui-nav-img "></span>'
                            +'<i class="layui-icon layui-icon-username"></i>'
                                +nickname
                            +data.data.created_at
                            +'<i class="layui-icon layui-icon-date"></i>'

                            +'</div>'
                            +'<div class="layui-col-md2">'+
                            '<button class="layui-btn-sm layui-btn "  onclick="answer_reply(this)" '
                            +'data-answer-id="'
                            +parseInt(data.data.answer_id)
                            +'" data-comment-id="'
                            +parseInt(data.data.comment_id)
                            +'" data-belog="0"> 回复</button>'
                            +'</div>'
                            +replyhtml
                            +data.data.comment
                            '</div>';

                            $('#'+'comment'+data.data.answer_id).append(html);

                    }break;

                    case 1:alert("收藏失败 请联系管理员");break;

                    case 2:$("#collect").html('收藏');break;

                    case 3:alert("取消收藏失败");break;

                    }

                }   ,
                error: function(){

                }
                });



            layer.close(index);//关闭窗口

        });

        }




        //收藏

        $("#collect").click(function () {

            var article_id={{$article->id}};

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




    //文章id  答案id   采纳
    function accept(obj)
    {
        var article_id=$(obj).attr("data-article-id");
        var answer_id=$(obj).attr("data-answer-id");
        var id="#"+$(obj).attr("data-id");

        $.ajax({
            type:"POST",
            url:"{{route('accept')}}",
            data:{a_id:article_id,an_id:answer_id,_token:csrf_token},
            datatype: "json",
            success:function(data){
                data=JSON.parse(data);
                switch (data.code) {

                    case 0:{
                        $(id).html("已采纳");
                        $(id).removeClass('accept-btn');
                        $(".accept-btn").hide(300);
                        $(".accept").hide(300);


                    }break;

                    case 1:alert("收藏失败 请联系管理员");break;

                    case 2:$("#collect").html('收藏');break;

                    case 3:alert("取消收藏失败");break;

                }

            }   ,
            error: function(){

            }
        });


    }


    //回复




    </script>




@endsection
