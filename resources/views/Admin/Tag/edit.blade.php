@extends("Admin.layouts.app")
@section("content")
   <div class="container">
        <div class="col-md-8">
        <form role="form" action="{{ url('admin/tagedit') }}" method="post" enctype="multipart/form-data">
       @csrf
            <input type="hidden" value="{{ $tag->id  }}" name="id">
        <div class="form-group">
            <label for="name">名称</label>
            <input type="text" class="form-control" name="name" id="name"  value="{{ $tag->name }}" placeholder="请输入名称">
        </div>

    <div class="form-group">
        <label for="name">标签描述信息</label>
        <textarea class="form-control" rows="3" name="baike">{{ $tag->baike }}</textarea>
    </div>

    <div class="form-group">
        <label for="name">所属标签</label>
        <select class="form-control"  name="tag_type_id">
        @foreach(\App\Models\TagType::all() as $tagtype)
      @if( $tagtype->id==$tag->tag_type_id )
            <option value="{{ $tagtype->id }}" selected>{{ $tagtype->type_name }}</option>
      @else
           <option value="{{ $tagtype->id }}">{{ $tagtype->type_name }}</option>
     @endif
        @endforeach
        </select>
    </div>

    <div class="form-group" >
        <label for="inputfile">标签图标</label>
        <input type="file" id="icofile" name="ico" class="form-control" name="ico"  value="{{ old('ico',$tag->ico) }}" onchange="ico2();" style="display:none;" >
        <p class="help-block"><img src="" width="30"  onclick="ico1()"  id="img" class="img-circle img-bordered-sm img-md"  style="float: none;"></p>
    </div>




<button type="submit" class="btn btn-info" >保存标签</button>
</form>
</div>
</div>


@endsection
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


</script>


