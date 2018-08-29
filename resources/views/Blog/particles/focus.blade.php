
<div class="layui-carousel" id="focus">
    <div carousel-item>
  @foreach($focus as $focu)
            <div><a href="{{ $focu->href }}"><img src="{{ Storage::url($focu->sico) }}" alt="{{ $focu->title }}加载失败"></a></div>
   @endforeach
    </div>
</div>
