
<div class="layui-col-md2 hack-right">


    <blockquote class="layui-elem-quote layui-quote-nm">
        <h2 class="layui-timeline-title">公告</h2>
<hr/>
        hello word
        关于此博客  欢迎你的加入
        hello是的法师的法师法师法撒旦法法
    </blockquote>




        <div class="layui-colla-item">
            <h2 class="layui-colla-title">热门文章</h2>

         @foreach($articlehots as $articlehot)
                <a href="{{url('articleshow/'.$articlehot->id)}}"><div class="layui-colla-content layui-show b-hover b-word">{{$articlehot->title}}</div></a>
         @endforeach


        </div>

    </div>

    </di>

</div>
