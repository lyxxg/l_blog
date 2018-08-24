@extends("Admin.layouts.app")
@section("content")

    @include("Admin.particles.warning")

    <table class="table table-striped">
        <caption><a href="{{ url('admin/typeview') }}"><button class="btn btn-info btn-lg margin">添加标签分类</button></a></caption>
        <thead>
        <tr>
            <th>id</th>
            <th>名称</th>
            <th>所拥有标签</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>

        @foreach($tagtypes as $tagtype)
        <tr>
            <td>{{ $tagtype->id }}</td>
            <td>{{ $tagtype->type_name }}</td>
            <td>
                <!--预防出现空情况-->
                @if(!empty($tagtype->tags))

                @foreach($tagtype->tags as $tag)
                |   {{ $tag->name }}
                @endforeach

                @else
                    未拥有标签
                @endif

            </td>

            <td>

                <form onsubmit="return confirm('删除标签分类是极致危险的操作 所拥有的标签 文章将全部被删除 需要管理员邮箱同意才可删除 确定发送邮箱?')" action="" method="post" id="delete_sub">
                    {{csrf_field()}}
                </form>

                <div  class="btn-group">
                    <button type="button" class="btn  btn-info"data-toggle="modal" data-name="{{ $tagtype->type_name }}" data-target="#myModal" data-id={{ $tagtype->id }} onclick="edit(this)" >编辑</button>
                    <a class="btn btn-del btn-danger">删除</a>
                </div>
            </td>
        </tr>

            @endforeach
        </tbody>
    </table>
@endsection


@include("Admin.TagType.js")