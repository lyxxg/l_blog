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
            <div class="layui-layer-title center-block">php是世界最好的语言</div>

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
                <td>2016-11-29</td>
                <td>人生就像是一场修行</td>
            </tr>

                @endforeach
                </tbody>
        </table>

    </div>

@endsection
