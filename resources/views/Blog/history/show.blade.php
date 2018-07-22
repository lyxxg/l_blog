@extends("Blog.layuots.app")
@section("content")
    <ul class="layui-timeline">
    @foreach($articles as $article)

        <li class="layui-timeline-item">
            <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
            <div class="layui-timeline-content layui-text">
                <h3 class="layui-timeline-title">{{date('m-d',strtotime($article->created_at))}}

                    </h3>

                <p>
              {{$article->title}}
                   </p>
            </div>
        </li>
        @endforeach
    </ul>


@endsection
