
@include("Blog.particles.header")
@include("Blog.particles.nav")
<link rel="stylesheet" href="{{asset('Editor/css/editormd.css')}}" />


        <div class="blog-box">


            <form class="layui-form" action="{{url('store')}}" method="post"> <!-- 提示：如果你不想用form，你可以换成div等任何一个普通元素 -->
                    {{csrf_field()}}


                @if(count($errors)>0)
                    @foreach($errors->all() as $error)


                        <div class="item layui-elem-quote blog-error layui-quote-nm">
                           {{$error}}

                        </div>                    @endforeach
                @endif





                <div class="layui-form-item">

                                <label class="layui-form-label">标题</label>
                                <div class="layui-input-block">
                                        <input type="text" name="title" placeholder="标题" autocomplete="off" class="layui-input" value="{{ old('title') }}">
                                </div>
                        </div>


                        <div class="layui-form-item">

                                <label class="layui-form-label">标签</label>
                                <div class="layui-input-block">

                                    @foreach($blogtags as $tag)

                                    <input type="checkbox" name="tag_id[]" title="{{$tag->name}}" value="{{$tag->id}}" >

                                    @endforeach

                                </div>

                        </div>


                        <div id="test-editormd">
                <textarea style="display:none;" name="content">{{ old('content') }}</textarea>
                        </div>

                    <div class="layui-form-item blog-center">
                        <button class="layui-btn" lay-submit lay-filter="*">立即提交</button>
                    </div>

                </form>

        </div>

<script src="{{asset('js/jquery.js')}}"></script>

<script src="{{asset('Editor/editormd.min.js')}}"></script>
<script type="text/javascript">
    var testEditor;

    $(function() {
        testEditor = editormd("test-editormd", {
            width   : "90%",
            height  : 640,
            syncScrolling : "single",
            path    : "Editor/lib/",
            toolbarAutoFixed: false,
            saveHTMLToTextarea: false,
            imageUpload: true,
            imageFormats : ["jpg","jpeg","gif","png","bmp","webp"],
            imageUploadURL:"{{url('uploadimage')}}"


        });

        /*
        // or
        testEditor = editormd({
            id      : "test-editormd",
            width   : "90%",
            height  : 640,
            path    : "../lib/"
        });
        */
    });
</script>
<script src="{{asset('blog/css/layui/layui.all.js')}}"></script>
