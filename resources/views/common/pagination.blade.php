{{--laravel 分页模板--}}

@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><span class="page-link">第一页</span></li>
        @else
            <li class="page-item"><a class="page-link"
                                     href="{{ $paginator->previousPageUrl() }}" rel="prev">上一页</a></li>
        @endif
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled">
                    <span class="page-link">{{ $element }}</span></li>
            @endif
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <span class="page-link">{{ $page }}</span></li>
                    @else


                        <li class="layui-page-item">
                            <a class="page-link" href="{{ $url }}">
                                {{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link"
                                     href="{{ $paginator->nextPageUrl() }}" rel="next">下一页</a></li>
        @else
            <li class="page-item disabled"><span
                        class="page-link">最后一页</span></li>
        @endif
    </ul>
@endif




<script type="text/javascript">
    //layui js分页
    layui.define([ 'element', 'form', 'layer', 'laypage' ], function(exports) {
        var element = layui.element();
        var form = layui.form();
        var layer = layui.layer;
        var laypage = layui.laypage;

        var pindex = "${requestScope.page.pindex}";// 当前页
        var ptotalpages = "${requestScope.page.ptotalpages}";// 总页数
        var pcount = "${requestScope.page.pcount}";// 总记录数
        var psize = "${requestScope.page.psize}";// 每一页的记录数

        // 分页
        laypage({
            cont : 'form_page', // 页面上的id
            pages : ptotalpages,//总页数
            curr : pindex,//当前页。
            skip : true,
            jump : function(obj, first) {

                $("#pindex").val(obj.curr);//设置当前页
                $("#psize").val($("#page_size").val())
                //防止无限刷新,
                //只有监听到的页面index 和当前页不一样是才出发分页查询
                if (obj.curr != pindex || psize != $("#psize").val()) {
                    document.f1.submit();
                }
            }
        });
    });
</script>