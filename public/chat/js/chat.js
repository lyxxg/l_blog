/**
 * Created by noxue on 2017/8/9.
 */

//默认给一个随机的昵称
var nickname = "游客 "+Math.random();

//websocket链接地址
var webSocket = new WebSocket("ws://127.0.01:666");


$(function () {

//连接成功后
webSocket.onopen = function (event) {
    //webSocket.send("Hello,WebSocket!");
    };



    webSocket.onmessage = function (event) {
        alert("q");
        data=JSON.parse(event.data);
        alert(data.data.data);
        var content = document.getElementById('nickname');
        nickname=data.data.nick;
      console.log(data);
        avatar='storage/'+data.data.savatar;
        console.log(avatar);

        var myDate=new Date();
        if(data.data.data.match("data:image/")) {
        msg=data.data.data;

        addMsg(nickname,msg,avatar,myDate.toLocaleTimeString(),1);
     }else {

            msg=data.data.data;

          addMsg(nickname,msg,avatar,myDate.toLocaleTimeString(),0);
        }
    };


    //发送消息按钮被单击
    $('.send-btn').click(function () {
        sendMsg($('#msg').val());
        $('#msg').val('');
    });



});

//发送消息
function sendMsg(msg){
    if(msg=='')
    return false;

    var data=new Array(2);

    nickname=HtmlUtil.htmlEncodeByRegExp(nickname);
    msg=HtmlUtil.htmlEncodeByRegExp(msg);

    data[0]=msg;
    data[1]=token;
    webSocket.send(data);

}


//1为图片  0消息
function addMsg(nickname, msg,avatar,time,type){

    var html = '';
//    console.log(avatar);
    //如果是图片
if(type==1){
    html += '<div class="msg-box">'
        +'<p class="nickname">'
        +'<span  class="avatar">'
        +'<img src="'+avatar+'" id="admin"></span>'
        +nickname
        +'<span>'
        +time
        +'</span></p>'
        +'<p class="msg">'
        +'<img src="'+msg+'">'
        +'</p>'
        +'</div>';

}else{
    html += '<div class="msg-box">'
        +'<p class="nickname">'
        +'<span  class="avatar">'
        +'<img src="'+avatar+'" id="admin"></span>'
        +nickname
        +'<span>'
        +time
        +'</span></p>'
        +'<p class="msg">'
        +msg
        +'</p>'
        +'</div>';
}
    $('.show-box').append(html);

    $('.show-box').scrollTop($('.show-box').scrollTop()+1000);



}



//发送图片
$('.send-img').click(function () {
   $("#imgFile").click();
});

//选择完图片后
$("#imgFile").change(function () {
var img=document.getElementById("imgFile").files[0];

if(!/image\/\w+/.test(img.type)){
        alert("仅支持图片发送");
        return false;
    }
    var reader=new FileReader();
    reader.readAsDataURL(img);
    reader.onload=function(){
//        alert(this.result);
        sendImg(this.result);
    }

//imgurl=window.URL.createObjectURL(img);
//console.log(msg);


})


function sendImg(msg) {
    avatar=document.getElementById("admin");
    avatar=getBase64Image(avatar);//当前用户头像
    var data=new Array(3);
    nickname=HtmlUtil.htmlEncodeByRegExp(nickname);
    data[0]=msg;
    data[1]=token;
    webSocket.send(data);

}


//获取图片base64
function getBase64Image(img) {
    var canvas = document.createElement("canvas");
    canvas.width = img.width;
    canvas.height = img.height;
    var ctx = canvas.getContext("2d");
    ctx.drawImage(img, 0, 0, img.width, img.height);
    var ext = img.src.substring(img.src.lastIndexOf(".") + 1).toLowerCase();
    var dataURL = canvas.toDataURL("image/" + ext);
    return dataURL;
}

//base64转二进制
function dataURLtoBlob(dataurl) {
    var arr = dataurl.split(','),
        mime = arr[0].match(/:(.*?);/)[1],
        bstr = atob(arr[1]),
        n = bstr.length,
        u8arr = new Uint8Array(n);
    while (n--) {
        u8arr[n] = bstr.charCodeAt(n);
    }
    return new Blob([u8arr], {
        type: mime
    });
}


function isImg(url) {
    var regex='blob:http';
    if(url.match(regex)){
    return true;
    }

}

//根据链接获取base
function getBase64Imageurl(img) {
    var canvas = document.createElement("canvas");
    canvas.width = img.width;
    canvas.height = img.height;
    var ctx = canvas.getContext("2d");
    ctx.drawImage(img, 0, 0, img.width, img.height);
    var ext = img.src.substring(img.src.lastIndexOf(".")+1).toLowerCase();
    var dataURL = canvas.toDataURL("image/"+ext);
    return dataURL;
}












document.onkeydown=function(event){
    var e = event || window.event || arguments.callee.caller.arguments[0];
    if(event.ctrlKey && event.keyCode == 13){ // 按 Esc
        //要做的事情
        sendMsg($('#msg').val());
        $('#msg').val('')

    }

    if(event.ctrlKey && event.keyCode == 79){ // 按 Esc
        //要做的事情
        $("#imgFile").click();

    }


};




var HtmlUtil = {
    /*1.用正则表达式实现html转码*/
    htmlEncodeByRegExp:function (str){
        var s = "";
        if(str.length == 0) return "";
        s = str.replace(/&/g,"&amp;");
        s = s.replace(/</g,"&lt;");
        s = s.replace(/>/g,"&gt;");
        s = s.replace(/ /g,"&nbsp;");
        s = s.replace(/\'/g,"&#39;");
        s = s.replace(/\"/g,"&quot;");
        return s;
    },
    /*2.用正则表达式实现html解码*/
    htmlDecodeByRegExp:function (str){
        var s = "";
        if(str.length == 0) return "";
        s = str.replace(/&amp;/g,"&");
        s = s.replace(/&lt;/g,"<");
        s = s.replace(/&gt;/g,">");
        s = s.replace(/&nbsp;/g," ");
        s = s.replace(/&#39;/g,"\'");
        s = s.replace(/&quot;/g,"\"");
        return s;
    }
};
