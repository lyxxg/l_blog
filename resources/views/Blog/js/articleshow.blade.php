<script>
var savatar=document.getElementById('savatar').src;
console.log(savatar);
var csrf_token=$("#collect_token").val();
var artcile_id=$("#article_id").val();
nickname=$("#nickname").val();

//回答
$("#answer").click(function () {
var content=$("#answer-content").val();

$.ajax({
type:"POST",
url:"{{route('answer.store')}}",
datatype:'json',
data:{'article_id':artcile_id,'content':content,'_token':csrf_token},
success:function(data){
switch (data.code) {
case 0:{
window.location.reload();//懒了。。 不想拼html了
}


}
},error:function () {
layer.msg('出bug了', {icon: 5,offset:top});

}
});//ajax end

});




//评论和回复
function answer_reply(obj)
{

var belog = $(obj).attr("data-belog");
var answer_id = $(obj).attr("data-answer-id");
var comment_id = $(obj).attr("data-comment-id") ? $(obj).attr("data-comment-id") : 0;
var typearticle = $(obj).attr("data-typearticle");

//兼容手机端设置
var w = document.documentElement.scrollWidth || document.body.scrollWidth;
if (w >= 600) {
layerw = 800 + "px";
layerh = 500 + "px";
} else {
layerw = 300 + "px";
layerh = 200 + "px";
}

layer.prompt({
offset: ['10px', '80px'],
formType: 2,
title: '回复',
area: [layerw, layerh] //自定义文本域宽高
}, function (value, index, elem) {
$.ajax({
type:"POST",
url:"{{route('comment')}}",
data:{'belog':belog,'answer_id':answer_id,'comment_id':comment_id,'typearticle':typearticle,'comment':value,_token:csrf_token},
datatype: "json",
success:function(data){
data=JSON.parse(data);

switch (data.code) {

case 0:{
var replyhtml='';
//alert(typeof (data.data.belog));   string类型
data.data.belog=parseInt(data.data.belog);
if(!data.data.belog){//回复
replyhtml+='<span style="color:green">回复</span>'+data.data.user+':';
}
var html='';
html+=
'<hr/><hr/>'
+'<div class="item">'
    +'<div class="layui-col-md10">'+
        '<span class="avatar"><img src="'
                            +savatar
                            +'" class="layui-nav-img "></span>'
        +'<i class="layui-icon layui-icon-username"></i>'
        +nickname
        +data.data.created_at
        +'<i class="layui-icon layui-icon-date"></i>'

        +'</div>'
    +'<div class="layui-col-md2">'+
        '<button class="layui-btn-sm layui-btn "  onclick="answer_reply(this)" '
        +'data-answer-id="'
        +parseInt(data.data.answer_id)
        +'" data-comment-id="'
        +parseInt(data.data.id)
        +'" data-belog="0"> 回复</button>'
        +'</div>'
    +replyhtml
    +data.data.comment
    '</div>';

$('#'+'comment'+data.data.answer_id).append(html);

}break;

case 1:alert("回复失败 请联系管理员");break;

// case 2:$("#collect").html('');break;

//case 3:alert("取消收藏失败");break;

}

}   ,
error: function(){
layer.msg('出bug了', {icon: 5,offset:top});

}
});



layer.close(index);//关闭窗口

});

}




//收藏

$("#collect").click(function () {

var article_id={{$article->id}};

$.ajax({
type:"POST",
url:"{{route('collect.store')}}",
data:{a_id:article_id,_token:csrf_token},
datatype: "json",
success:function(data){
data=JSON.parse(data);


switch (data.code) {

case 0:$("#collect").html('已收藏');break;

case 1:alert("收藏失败 请联系管理员");break;

case 2:$("#collect").html('收藏');break;

case 3:alert("取消收藏失败");break;

}

}   ,
error: function(){
layer.msg('出bug了', {icon: 5,offset:top});

}
});

})



//文章id  答案id   采纳  这个功能去掉
function accept(obj)
{
var article_id=$(obj).attr("data-article-id");
var answer_id=$(obj).attr("data-answer-id");
var id="#"+$(obj).attr("data-id");

$.ajax({
type:"POST",
url:"{{route('accept')}}",
data:{a_id:article_id,an_id:answer_id,_token:csrf_token},
datatype: "json",
success:function(data){
data=JSON.parse(data);
switch (data.code) {

case 0:{
$(id).html("已采纳");
$(id).removeClass('accept-btn');
$(".accept-btn").hide(300);
$(".accept").hide(300);


}break;

case 1:alert("收藏失败 请联系管理员");break;

case 2:$("#collect").html('收藏');break;

case 3:alert("取消收藏失败");break;

}

}   ,
error: function(){

}
});


}

</script>