@extends("Blog.layuots.nosider")
@section("content")




    <div class="article-list">

    <div class="layui-container blog-mtop box-min">
        <div class="layui-row">


                <ul class="">
    @foreach($collects as $article)


                      <li class="layui-col-md3">
                          <a href="{{url('articleshow/'.$article->article->id)}}">

     <blockquote class="layui-elem-quote blog-mtop">
     {{$article->article->title}}
         <p>收藏時間:{{$article->created_at}}</p>
     </blockquote>        </a>

                      </li>
    @endforeach
                </ul>

             </div>
        </div>
    </div>



@endsection