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
                        <span class="avatar"><img src="{{ Storage::url(Blog::getUserInfo($article->user_id)->savatar) }}" class="layui-nav-img "></span>

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
                     <textarea style="display:none;" name="editormd-markdown-doc">{!! $article->content !!}</textarea>
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

            <input type="hidden" name="article_id" value="{{$article->id}}">
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">评论一下吧</label>
                    <div class="layui-input-block">
                        <textarea  placeholder="请输入内容" class="layui-textarea" id="answer-content"></textarea>
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="formDemo" id="answer">回答</button>
                    </div>
                </div>





            @foreach($answers as $answer)

                <div class="item layui-elem-quote comment" id="comment{{$answer->id}}">
                    <div class="layui-col-md10">
                        #{{$answer->id}}<span class="avatar"><img src="{{ Storage::url(Blog::getUserInfo($answer->user_id)->savatar) }}" class="layui-nav-img "></span>
                        <i class="layui-icon layui-icon-username"></i>{{Blog::getUserInfo($answer->user_id)->nick}}
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
                                <span class="avatar"><img src="{{ Storage::url(Blog::getUserInfo($comment->user_id)->savatar) }}" class="layui-nav-img "></span>
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
    <input type="hidden" value="{{$article->id}}" id="article_id">


    <script src="{{asset('blog/css/layui/lay/modules/layer.js')}}"></script>

    {{--注意 用<script src="">引入会失败--}}
    @include("Blog.js.articleshow")

@endsection

