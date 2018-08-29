
{{--当删除按钮按下的时候--}}
<script src="http://lib.baomitu.com/jquery/3.2.0/jquery.min.js"></script>
<script>
    $(function(){
        $(".btn-del").click(function () {
            $(this).siblings("form:first").submit();
        });
    });

</script>
