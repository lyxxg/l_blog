@extends("Blog.layuots.nosider")
@section("content")

    <div class="layui-container " >
        <div class="layui-row ">
            <div class="blog-box blog-box2"  style="height: 600px">
                <div class="">


    <form class="layui-form" action="{{route('user.update',$user->id)}}"  method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        {{method_field("put")}}



        <h2 class="layui-timeline-title" contenteditable="true" id="nick1">
            {{$user->info->nick}}
        </h2>

        <input type="hidden" name="nick" value="{{$user->info->nick}}" id="nick2">

        <input type="file" class="form-control"  name="avatar" value="" placeholder="头像" style="display: none"
               id="icofile"      onchange="ico2();">

        <div class="blog-avatar "><img src="{{Storage::url($user->info->avatar)}}" onclick="ico1()" class="blog-mtop" id="img"></div>


        <div class="layui-form-item blog-mtop" >

            <div class="layui-input-block">

                <input type="radio" name="sex" value="1" title="男" {!! $user->info->sex==1?'checked':'' !!}>
                <input type="radio" name="sex" value="0" title="女" {!! $user->info->sex==0?'checked':'' !!}>
                <input type="radio" name="sex" value="3" title="保密" {!! $user->info->sex==3?'checked':'' !!}>
            </div>
                </div>


        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">个性签名</label>
            <div class="layui-input-block">
                <textarea name="desc" placeholder="展示你的个性吧" class="layui-textarea">
                    {{$user->info->description}}
                </textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formDemo" id="send">立即修改</button>
            </div>
        </div>
    </form>

                </div></div></div></div>


    <script src="{{asset('js/jquery.js')}}" type="text/javascript"></script>
    <script>
        function ico1() {
            //我靠 ico居然是关键字
            //onchange="fileSelected();"
            document.getElementById("icofile").click();
        }

        function ico2() {
            // 文件选择后触发次函数

            var $file = $("#icofile");
            var fileObj = $file[0];
            var windowURL = window.URL || window.webkitURL;
            var dataURL;

            var $img = $("#img");
            if (fileObj && fileObj.files && fileObj.files[0]) {
                dataURL = windowURL.createObjectURL(fileObj.files[0]);
                $img.attr('src', dataURL);

            } else {
                dataURL = $file.val();
                var imgObj = document.getElementById("preview");
                imgObj.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
                imgObj.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = dataURL;
            }
        }


        $("#send").click(function () {
            var nick=$("#nick1").html();
            $("#nick2").val(nick);
        })

    </script>

@endsection
