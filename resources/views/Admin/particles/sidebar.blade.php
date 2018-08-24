<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{Storage::url(Blog::getUserInfo()->savatar)}}"  alt="User Image" style="border-radius: 999px" >
            </div>
            <div class="pull-left info">
                <p>{{Blog::getUserInfo()->nick}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="搜索文章">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">文章管理</li>
            <li class="active treeview">
                <a href="{{ url('admin') }}">
                    <i class="fa fa-dashboard"></i> <span>主页</span>
                    <span class="pull-right-container">
            </span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>文章</span>
                    <span class="pull-right-container">
              <span class="label label-primary pull-right">3 </span>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/article') }}"><i class="fa fa-circle-o"></i> 文章管理 </a></li>
                    <li><a href="{{ url('admin/revlist') }}"><i class="fa fa-circle-o"></i> 文章回收 </a></li>
                    <li><a href="{{ url('admi/article') }}"><i class="fa fa-circle-o"></i> 文章分类 </a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-share"></i> <span> 标签管理 </span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/tagtype') }}"><i class="fa fa-circle-o"></i> 标签分类管理 </a></li>

                    <li><a href=""><i class="fa fa-circle-o"></i> 标签分类添加 </a></li>


                    <li><a href="#"><i class="fa fa-circle-o"></i> 标签添加 </a></li>

                    <li><a href="#"><i class="fa fa-circle-o"></i> 标签分类添加 </a></li>
                </ul>
            </li>

            <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
            <li class="header">用户管理</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span> 用户 </span></a></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-circle-o text-yellow"></i>
                    <span>权限管理</span>
                    <span class="pull-right-container">
              <span class="label label-primary pull-right">3 </span>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> 权限管理 </a></li>
                    <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> 添加权限 </a></li>
                    <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> 赋予权限 </a></li>
                </ul>
            </li>


            </span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
