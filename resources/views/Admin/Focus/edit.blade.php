@extends('admin.layouts.app')
@section("content")
    <section class="content-header">
        <h1 title="这里管理焦点图">
            焦点图
            <small title="焦点图">Focus</small>
        </h1>
        <ol class="breadcrumb">
            <li title="主页"><a href=""><i class="fa fa-home"></i>
                    主页</a></li>
        </ol>
    </section>
    <span style="display: none">{{$i=1}}</span>

    <!-- Main content -->
    <form action="{{ url('admin/focus') }}" method="post" enctype="multipart/form-data">
        @foreach($focus as $focu)

            {{csrf_field()}}
            <section class="content adminfutrue">
                <!-- general form elements -->
                <input type="hidden" value="{{$focu->id}}" name="id{{$focu->id}}">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">焦点图{{$i++}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">标题</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="标题"
                                   value="{{$focu->title}}" name="titles[]">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">链接</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="链接"
                                   value="{{$focu->href}}" name="hrefs[]">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">上传焦点图</label>
                            <input type="file" id="icofile{{ $i-1 }}"      onchange="ico2({{ $i-1 }})" value=""
                                   name="icos{{ $i-1 }}" style="display: none">

                            <img src="{{ Storage::Url($focu->sico) }}" class="admin-futrue-focus" style="max-height: 5%;max-width: 10%" onclick="ico1({{ $i-1 }})"
                                 id="img{{ $i-1 }}">
                            <p class="help-block">830px 300px</p>
                        </div>
                    </div>
                    <!-- /.box-body -->


                </div>
            </section>

        @endforeach

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>


    </form>

    </body>
    </html>

@endsection
@section("js")

    <script>
        function ico1(i) {
            document.getElementById("icofile"+i).click();
        }

        function ico2(i) {
            // 文件选择后触发次函数
            var $file = $("#icofile"+i);
            var fileObj = $file[0];
            var windowURL = window.URL || window.webkitURL;
            var dataURL;

            var $img = $("#img"+i);
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
