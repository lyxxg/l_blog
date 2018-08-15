@extends("Blog.layuots.nosider")
@section("content")

     <div class="layui-container">
     <div class="layui-row">
     <div class=""  style="height: 600px">

        @foreach($notices as $notice)

         <div class="notices blog-mtop">
                 <blockquote class="layui-elem-quote layui-quote-nm">
                     <span><img src="{{Storage::url(Blog::getUserInfo($notice->object_user_id)->avatar)}}" class="layui-nav-img"></span>
                     <span>{{Blog::getUserInfo($notice->object_user_id)->nick}}</span>
                     <em>
                         @if($notice->action=='answer')
                            回答
                         @elseif($notice->action=='comment')
                            评论
                         @else
                            回复</em>
                         @endif
                     关于您
                     <span>
                         <a href="{{url('articleshow/'.$notice->article_id)}}">
                    @if($notice->action=='answer')
                     <a href="{{url('articleshow/'.$notice->article->id)}}"> {{$notice->article->title}}
                     @elseif($notice->action=='comment')
                             <a href="{{url('articleshow/'.$notice->answer->article_id)}}">
                                 {{$notice->comment->comment}}</a>
                     @else
                      <a href="{{url('articleshow/'.$notice->answer->article_id)}}">
                                 {{$notice->comment->comment}} </a>
                     @endif


                     </span>
                     <hr/>
                     @if($notice->action=='answer')
                         回答
                     @elseif($notice->action=='comment')
                         评论
                     @else
                         回复
                     @endif

                     内容:
                     @if($notice->action=='answer')
                         {{$notice->msg}}
                     @else
                          {{$notice->msg}}
                     @endif
                 </blockquote>


         @endforeach


     </div>
     </div>
     </div>


@endsection