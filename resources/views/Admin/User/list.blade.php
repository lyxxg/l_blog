@extends('Admin.layouts.app')
@section("content")
        <div class="box-body">

            <table class="table table-bordered">
                <thead>
                <tr>
                    <td><i class="fa fa-circle">用户编号</i></td>
                    <td><i class="fa fa-user">用户名</i></td>
                    <td><i class="fa fa-bookmark">昵称</i></td>

                    <td><i class="fa fa-tag">头像</i></td>
                    <td><i class="fa fa-trash">操作</i></td>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td title="用户编号:{{$user->id}}">{{$user->id}}</td>
                        <td title="用户名:{{$user->name}}">
                                {{$user->name}}</td>
                        <td title="{{$user->info->nick}}">
                                {{str_limit($user->info->nick, 6,'...')}}
                        </td>
                        <td>
                            <img src="{{Storage::url($user->info->savatar)}}" class="img-circle img-md img-bordered-sm">


                        </td>

                        <td>
                            @if(!in_array($user->id,$bannedarr))
                                <a href="#" class="btn btn-danger btn-sm btn-del" title="小黑屋">小黑屋</a>
                                <form onsubmit="return confirm('您是否确定要将该用户加入小黑屋')" action="{{ url('admin/bannedadd',$user->id) }}" method="post">
                                    {{csrf_field()}}
                                </form>

                            @else
                                <a href="#" class="btn btn-primary btn-sm btn-del" title="放出小黑屋">放出小黑屋</a>
                                <form onsubmit="return confirm('您是否确定要将该用户放出小黑屋?')" action=" {{ url('admin/bannedel',$user->id) }}"  method="post">
                                <form onsubmit="return confirm('您是否确定要将该用户放出小黑屋?')" action=" {{ url('admin/bannedel',$user->id) }}"  method="post">
                                    @csrf
                                    <input type="hidden" value="1" name="status">
                                </form>

                            @endif
                            <a href="#" class="btn btn-primary btn-sm btn-add" title="添加到管理员">添加到管理员</a>
                            <form onsubmit="return confirm('您是否确定要将该用户添加到管理员')" action="('admin.roles.store',$user->id)}}"  method="post">
                                {{csrf_field()}}
                                <input type="hidden" value="{{$user->id}}" name="user_id">
                                {{method_field('post')}}
                            </form>

                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        @endsection
        @section("js")

            <script src="http://lib.baomitu.com/jquery/3.2.0/jquery.min.js"></script>
            <script>
                $(function(){
                    $(".btn-del").click(function () {

                        $(this).siblings("form:first").submit();
                    });
                });


                $(function () {
                    $(".btn-add").click(function () {
                        $(this).siblings("form:last").submit();
                    })
                })

            </script>