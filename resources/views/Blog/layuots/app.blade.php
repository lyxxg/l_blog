




<!--header start--!>

@include("Blog.particles.header")

<!---header end-->


<!---nav start-->
@include("Blog.particles.nav")
<!--nav end-->


    <div class="layui-container ">

        <div class="layui-row ">



            <div class="layui-col-md9">

                <!---focus start-->



                <!---focus end-->




                <!--article start-->

                @section("content")


                @show

                <!--article end-->




            </div>




            <!--siderbar right start-->

            @include("Blog.particles.sidebar")

            <!--siderbar right end-->

        </div>


        <!---footer-->

        @include("Blog.particles.footer")
        <script>
            //focus config
            layui.use('carousel', function(){
                var carousel = layui.carousel;
                carousel.render({
                    elem: '#focus',
                    width: '100%' //设置容器宽度
                });
            });
        </script>
