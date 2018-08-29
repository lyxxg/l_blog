@extends("Admin.layouts.app")
@section("content")

    <div class="container">
        <div class="col-md-8">
        <form role="form" action="{{ url('admin/tagadd') }}" method="post" enctype="multipart/form-data">
       @csrf
        <div class="form-group">
            <label for="name">名称</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="请输入名称">
        </div>

    <div class="form-group">
        <label for="name">标签描述信息</label>
        <textarea class="form-control" rows="3" name="baike"></textarea>
    </div>

    <div class="form-group">
        <label for="name">所属标签</label>
        <select class="form-control"  name="tag_type_id">
        @foreach(\App\Models\TagType::all() as $tagtype)
            <option value="{{ $tagtype->id }}">{{ $tagtype->type_name }}</option>
        @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="inputfile">标签图标</label>
        <input type="file" id="inputfile" name="ico">
        <p class="help-block">这里是块级帮助文本的实例。</p>
    </div>




<button type="submit" class="btn btn-info">添加新标签</button>
</form>
</div>
</div>


@endsection
