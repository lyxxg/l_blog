<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>未来笔记- 简易聊天室</title>
    <link rel="stylesheet" href="{{ asset('chat/css/chat.css') }}">
</head>
<body>
<div class="chat-box">
    <div class="show-box">

        @foreach($chats as $chat)
        <div class="msg-box">

            <p class="nickname" id="nickname">
                <span  class="avatar"><img src="{{ $chat->nick }}" id="admin"></span>
                <em class="nickname-em">{{ $chat->nick }}</em><span class="time">{{ date('h:m',$chat->time) }}</span></p>

            <p class="msg">
                {{ $chat->data }}
            </p>
        </div>

        @endforeach
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
    //用户token 每次发送消息token都会重新生成  所以token只能用一次
    var token='{{ $u_token }}';
    localStorage.setItem('chat_token',token);//缓存h5本地

    var is_mobile='{{ Blog::is_mobile() }}';

</script>
<script src="{{ asset('chat/js/jquery.min.js') }}"></script>
<script src="{{ asset('chat/js/mobile.js') }}"></script>


<script src="{{ asset('chat/js/chat.js') }}"></script>

</body>
</html>