@include("Admin.particles.head")
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
@include("Admin.particles.header")

@include("Admin.particles.sidebar")
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ request()->route()->getName() }}
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('主页') }}"><i class="fa fa-dashboard"></i>主页</a></li>
                <li class="active"><a href="javascript:void">{{ request()->route()->getName() }}</a></li>
            </ol>
        </section>
        @section("content")

        <section class="content">
            {{--内容区域--}}




        </section>
        @show

    </div>

@include("Admin.particles.footer")

@include("Admin.particles.js")
</body>
</html>
