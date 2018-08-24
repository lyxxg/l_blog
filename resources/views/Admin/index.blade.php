@extends("Admin.layouts.app")
@section("content")


    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">今日总点击量</span>
                        <span class="info-box-number">{{ \Redis::get("count") }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>


            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">总用户</span>
                        <span class="info-box-number">{{ $UserCount }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->




            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-android-phone-portrait"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">今日独立ip访问量</span>
                        <span class="info-box-number">{{ $IpCount }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->



            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">文章总数</span>
                        <span class="info-box-number"> {{ $ArticleCount }} </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->


        </div>
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">用户浏览器使用情况  (按ip)</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="chart-responsive">
                            <canvas id="pieChart" height="150"></canvas>
                        </div>
                        <!-- ./chart-responsive -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4">
                        <canvas id="pieChart2" height="150"></canvas>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="#">United States of America
                            <span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>
                    <li><a href="#">India <span class="pull-right text-green"><i class="fa fa-angle-up"></i> 4%</span></a>
                    </li>
                    <li><a href="#">China
                            <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> 0%</span></a></li>
                </ul>
            </div>
            <!-- /.footer -->
        </div>

        <!-- /.box -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
        <script>
            var allbrowserval={!! $AllBrowser !!}
            var allbrowserkey={!! json_encode(Blog::AllBrowser()) !!}
            var mobile={!! $mobile !!}
            //chart.js图表插件
            var ctx = document.getElementById('pieChart').getContext('2d');

            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'doughnut',

                // The data for our dataset
                data: {
                    labels:allbrowserkey ,
                    datasets: [{
                        label: "browser",
                        //浏览器颜色本人色盲  不想填
                        backgroundColor: ['red','rgb(11,11,11)','green',
                        'white','blue','yellow','rgb(115, 1,0)','rgb(32, 1,0)','rgb(98, 65,0)'
                        ,'rgb(120,120,120)'],

                        borderColor: [],  //边框颜色
                        data: allbrowserval,
                    }]
                },

                // Configuration options go here
                options: {}
            });



            var ctx = document.getElementById('pieChart2').getContext('2d');

            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'doughnut',

                // The data for our dataset
                data: {
                    labels: ["桌面", "移动"],
                    datasets: [{
                        label: "My First dataset",
                        backgroundColor: ['rgb(255, 99, 132)','rgb(255,255,14)'],
                        borderColor: 'rgb(255, 99, 132)',
                        data: mobile,
                    }]
                },

                // Configuration options go here
                options: {}
            });



        </script>


            </section>
@endsection("后台")