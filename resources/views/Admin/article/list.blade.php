@extends("Admin.layouts.app")
@section("content")

@include("Admin.particles.warning")
<div class="box-body">

<table class="table table-hover">
    <thead>
    <tr>
        <td><i class="fa fa-circle">文章号</i></td>
        <td><i class="fa fa-user">作者</i></td>
        <td><i class="fa fa-bookmark">标题</i></td>
        <td><i class="fa fa-tag">标签</i></td>
        <td><i class="fa fa-eye">阅读量</i></td>
        <td><i class="fa fa-trash">撤销</i></td>
    </tr>
    </thead>

    <tbody>
    @foreach($articles as $article)
    <tr>
        <td title="未来号:{{$article->id}}">{{$article->id}}</td>
        <td title="编写者:{{$article->user->info->nick}}"><a href="">{{$article->user->info->nick}}</a></td>
        <td title="{{$article->title}}">
            <a href="">
                {{str_limit($article->title, 6,'...')}}
            </a>
        </td>
        <td>
            @foreach($article->tags as $tag)
                <a href="" title="{{$tag->name}}">{{($tag->name)}}</a>
            @endforeach
        </td>

        <td title="阅读量:{{$article->view}}">{{$article->view}}</td>
        <td>
            <a href="#" class="btn btn-danger btn-sm btn-del" title="撤销的文章可以在回收站恢复">撤销</a>
            <form onsubmit="return confirm('您是否确定要撤销该文章？{{ $article->title }}')" action="{{ url('admin/articledel',$article->id) }}" method="post" id="delete_sub">
                {{csrf_field()}}
            </form>

        </td>

    </tr>

    @endforeach
    </tbody>
</table>
{{$articles->appends(['type'=>request()->get('type','last')])->links()}}

</div>

@endsection
<script src="http://lib.baomitu.com/jquery/3.2.0/jquery.min.js"></script>
<script>
    $(function(){
        $(".btn-del").click(function () {
            $(this).siblings("form:first").submit();
        });
    });

</script>
