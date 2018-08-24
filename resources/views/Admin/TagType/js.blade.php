<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    编辑
                </h4>
            </div>
            <div class="modal-body">
                <form  action="{{ url('admin/typeadd') }}" method="post">
                    <div class="form-group">
                        <label for="name">编辑标签分类名称</label>
                        <input type="hidden" name="id" id="type_id">
                        <input type="text"  class="form-control" id="type_name" placeholder="请输新入名称">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                </button>
                <button type="button" class="btn btn-primary" id="tagtype-edit">
                    提交更改
                </button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>

<input type="hidden" id="edit-url" value="{{ url('admin/typedit') }}">

<script src="http://lib.baomitu.com/jquery/3.2.0/jquery.min.js"></script>
<script>

    var id,type_name;

    //编辑标签按钮被点击时
    function edit(obj) {
    var  name=$(obj).attr('data-name');
    var  id=$(obj).attr('data-id');
    $("#type_name").val(name);
    $("#type_id").val(id);
    }


    //添加标签分类
    var csrf_token='{{ csrf_token() }}';
    $("#tagtype-edit").click(function () {

    var editurl=$("#edit-url").val();
   var id=$("#type_id").val();
    var type_name=$("#type_name").val();//再次获取修改后的名称
 //       alert(editurl);
    $.ajax({
        type: "POST",
        url: editurl,
        data: {'id':id,'type_name':type_name,'_token': csrf_token},
        datatype: "json",
        success: function (data) {
        data = JSON.parse(data);
        //不想写js了 直接刷新页面  数据已经返回来
            location.reload();
        console.log(data)
        }, error: function () {

        alert("网络错误");
        }
    });

    });


    //删除
    $(function(){
        $(".btn-del").click(function () {
            $("#delete_sub").submit();
        });
    });

</script>
