@extends("Blog.layuots.app")
@section("content")


    <div class="blog-box">

        <table class="layui-table">
            <colgroup>
                <col >
                <col width="200">
                <col width="150">
            </colgroup>
            <thead>
            <div class="layui-layer-title center-block">{{$tags[0]->tag->name}}</div>

            <tr>
                <th>文章标题</th>
                <th>所有标签</th>
                <th>时间</th>
            </tr>
            </thead>
            <tbody>

            @foreach($tags as $tag)
            <tr>
                <td>{{$tag->article->title}}</td>
                <td>{{$tag->tag->name}}</td>
                <td>{{$tag->article->created_at}}</td>
            </tr>

                @endforeach
                </tbody>
        </table>

    </div>
    {{$tags->links()}}

@endsection
