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
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>
        <section class="content">
            {{--内容区域--}}
            @section("content")



            @stop

        </section>
    </div>

@include("Admin.particles.footer")

@include("Admin.particles.js")
</body>
</html>
