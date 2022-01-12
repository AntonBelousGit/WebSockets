<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div>
        @if ($id == 1)
            <h3>Комната 1</h3>
        @elseif ($id == 2)
            <h3>Комната 2</h3>
        @else
            <h3>Комната 3</h3>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-3">
        Пользователи онлай
        <ul id="users">

        </ul>
    </div>
    <div class="col-5">
        Cooбшения
        <div id="messages">

        </div>
    </div>
    <div class="col-3">
        <input type="text" id="text">
        <button id="send" onclick="send()">Отправить</button>
    </div>
</div>
</body>
<script>
    let socket = new WebSocket("ws://192.168.0.108:8080");
    // let socket = new WebSocket("wss://mysite.com/wss");

    socket.onopen = function (e) {
        socket.send('{"message":"new room","value": "{{$room_name}}","user":"{{$name}}"}');
        console.log('Соединение установлено');
    };

    socket.onmessage = function (event) {
        console.log(` Данные получены с сервера: ${event.data}`);
        let json = JSON.parse(event.data);
        if (json.message == 'connection') {
            const  deleteElement = document.querySelector('#users')
            deleteElement.innerHTML = '';
            json.users.map(function (item) {
                let users = document.getElementById('users');
                let liFirst = document.createElement('li');
                liFirst.innerHTML = "<li><span>"+item+"</span></li>"
                users.prepend(liFirst);
            })
        }
        else if(json.message == 'message')
        {
            let messages = document.getElementById('messages');
            let pFirst = document.createElement('p');
            pFirst.innerHTML = "<b>"+json.users+"</b>: " + json.value;
            messages.prepend(pFirst);
        }
    };

    socket.onclose = function (event) {
        if (event.wasClean) {
            console.log(`Соединение закрыто чисто, код=${event.code} причина=${event.reason}`);
        } else {
            // например, сервер убил процесс или сеть недоступна
            // обычно в этом случае event.code 1006
            console.log('Соединение прервано');
        }
    };

    socket.onerror = function (error) {
        console.log(`Ошибка ${error.message}`);
    };

    function send(){
        let text = document.getElementById('text').value;
        // Для сервера
        // fetch('',{
        //     method:'POST',
        //     headers: {
        //         'Content-Type': 'application/json;charset=utf-8'
        //     },
        //     body: JSON.stringify({text:text})
        // })
        socket.send('{"message": "new message", "value": "'+text+'"}');
    }
</script>
</html>
