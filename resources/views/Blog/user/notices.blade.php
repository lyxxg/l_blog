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
                     <em>{{$notice->action=='answer'?'回答':1}}</em>关于您
                     <span>{{$notice->article->title}}</span>:
                     <hr/>
                     {{$notice->answer->content}}
                 </blockquote>





         @endforeach


     </div>
     </div>
     </div>



@endsection