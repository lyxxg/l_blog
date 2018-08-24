@extends("Blog.layuots.nosider")
@section("content")
<div class="layui-container " >
    <div class="layui-row ">
<div class="blog-box blog-box2"  style="height: 600px">
   <div class="">

       <h2 class="layui-timeline-title">
   {!! $user->info->nick !!}
      </h2>
   </div>


     <div class="blog-avatar"><img src="{{ Storage::url($user->info->avatar) }}" onclick="avatarup()" id="avatar"></div>
     {!! Blog::getSex($user->info->sex) !!}
    <input type="file" style="display: none" id="fileimg" onchange="ajaxup()">
    {{csrf_field()}}

    <blockquote class="layui-elem-quote layui-quote-nm">{{ $user->info->description }}</blockquote>

    


    <div class="layui-btn-container">
        <a href="{{ route('user.edit',$user->id) }}"><button class="layui-btn blog-user-btn">编辑</button></a>
        <a href="{{ route('history.show',$user->id) }}"><button class="layui-btn blog-user-btn">历史</button></a>
        <a href="{{ route('collect.show',$user->id) }}"><button class="layui-btn blog-user-btn">收藏</button></a>
        <button class="layui-btn blog-user-btn">密码修改</button>

    </div>

</div>
</div>
</div>

<script>

//上传头像
var token='{{ csrf_token() }}';
var user_id='{{ $user->id }}';
function avatarup()
{
document.getElementById('fileimg').click();
}

function ajaxup(){

var obj=document.getElementById("fileimg").files[0] ;
var FormD=new FormData();
var xhr=new XMLHttpRequest();

FormD.append('_token',token);
FormD.append('user_id',user_id);
FormD.append('savatar',obj);
xhr.open('POST',"{{route('avatarup')}}");
//  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 万恶之源

xhr.onreadystatechange = function(){

    if(xhr.readyState == 4 && xhr.status == 200) {//保存成功并返回头像

    var data = eval('(' + xhr.responseText + ')');

     document.getElementById('avatar').src=data.data.avatar;
     document.getElementById('savatar').src=data.data.avatar;

    }else{

    }

}
xhr.send(FormD);

}

</script>

@endsection