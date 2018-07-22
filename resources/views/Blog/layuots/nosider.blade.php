<!--header start--!>

@include("Blog.particles.header")

        <!---header end-->


<!---nav start-->
@include("Blog.particles.nav")
<!--nav end-->


<div class="layui-container ">

    <div class="layui-row ">

            <!--article start-->

        @section("content")


        @show

        <!--article end-->



        </div>




        <!--siderbar right start-->


    <!--siderbar right end-->

    </div>


    <!---footer-->

    @include("Blog.particles.footer")
