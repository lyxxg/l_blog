@extends("Admin.layouts.app")
@section("content")

    <form class="form-horizontal" action="{{ url('admin/typeadd') }}" method="post" style="margin-top:8%">

            @csrf


        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">名称</label>
            <div class="col-sm-10">
                <input type="text" name="type_name" class="form-control" id="firstname" placeholder="请输入名称">
            </div>
        </div>

        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">id</label>
            <div class="col-sm-10">
                <input type="text" name="order_id"class="form-control" id="lastname" placeholder="请输入排序id">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success" style="width: 100%">添加</button>
            </div>
        </div>

    </form>

@endsection
