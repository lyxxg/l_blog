@extends("Admin.layouts.app")
@section("content")

    @include("Admin.particles.warning")

    <table class="table table-striped">
        <caption><a href="{{ url('admin/tagview') }}"><button class="btn btn-info btn-lg margin">添加新标签</button></a></caption>
        <thead>
        <tr>
            <th>id</th>
            <th>标签名称</th>
            <th>图标</th>
            <th>热度</th>
            <th>所属分类</th>
            <th>操作</th>

        </tr>
        </thead>
        <tbody>

        @foreach($tags as $tag)
            <tr>
                <td>{{ $tag->id }}</td>
                <td>{{ $tag->name }}</td>
                <td><img src="{{ Storage::url($tag->ico)  }}" class="img-circle img-bordered-sm img-sm"></td>
                <td>{{ $tag->hot }}</td>
                <td>{{ $tag->tagtype->type_name }}</td>
                <td>



                    <div  class="btn-group">

                        <a href="{{ url('admin/tageditview',$tag->id) }}" class="btn btn-del btn-info">编辑</a>
                        <a class="btn btn-del btn-danger">删除</a>
                        <form onsubmit="return confirm('删除标签分类是极致危险的操作 所拥有的标签 文章将全部被删除 需要管理员邮箱同意才可删除 确定发送邮箱?')" action="" method="post" id="delete_sub">
                            {{csrf_field()}}
                        </form>

                    </div>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>
@endsection
@include("Admin.particles.deljs")
