<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>未来笔记- 简易聊天室</title>
    <link rel="stylesheet" href="{{ asset('chat/css/chat.css') }}">
</head>
<body>
<div class="chat-name">未来笔记-网页聊天室<p id="token">{{ $u_token }}</p></div>
<div class="chat-box">
    <div class="show-box">
        <div class="msg-box">

            <p class="nickname" id="nickname">
                <span  class="avatar"><img src="{{ asset('chat/img/bg.jpg') }}" id="admin"></span>
                <em class="nickname-em">管理员</em><span>很多年前</span></p>

            <p class="msg">
                欢迎来到加入群聊。。。

            </p>
        </div>
    </div>
    <div class="send-box">
        <p>
            <textarea name="msg" id="msg" cols="30" rows="10" ></textarea>
        </p>
        <input type="file" type="file" id="imgFile" name="imgFile" style="display: none">
        <p><img src="{{ asset('chat/img/sendimg.png') }}" class="send-img" title="ctrl+o快捷打开"><button class="send-btn">发送信息(Ctrl+Enter)</button></p>

    </div>
    </div>

<script>
    //用户token 每次发送消息token都会重新生成  所以token只能用一次 别想搞事情
    var token='{{ $u_token }}';
    localStorage.setItem('chat_token',token);//缓存h5本地
</script>
<script src="{{ asset('chat/js/jquery.min.js') }}"></script>
<script src="{{ asset('chat/js/chat.js') }}"></script>

</body>
</html>