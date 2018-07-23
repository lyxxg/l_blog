@extends("Blog.layuots.nosider")
@section("content")
<div class="layui-container " >
    <div class="layui-row ">
<div class="blog-box blog-box2"  style="height: 600px">
   <div class="">

       <h2 class="layui-timeline-title">
{{$user->info->nick}}
      </h2>
   </div>


     <div class="blog-avatar"><img src="{{Storage::url($user->info->avatar)}}"></div>
     {!!Blog::getSex($user->info->sex)!!}

    <blockquote class="layui-elem-quote layui-quote-nm">{{$user->info->description}}</blockquote>

    


    <div class="layui-btn-container">
        <a href="{{route('user.edit',$user->id)}}"><button class="layui-btn blog-user-btn">编辑</button></a>
        <a href="{{route('history.show',$user->id)}}"><button class="layui-btn blog-user-btn">历史</button></a>
        <a href="{{route('collect.show',$user->id)}}"><button class="layui-btn blog-user-btn">收藏</button></a>
        <button class="layui-btn blog-user-btn">粉丝</button>

    </div>

</div>
</div>
</div>
@endsection