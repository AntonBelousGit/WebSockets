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


    <form action="/room">
        <div>
            <input type="text" name="name" placeholder="Имя">
        </div>
        <div class="col-3">
            <label>Комната 1</label>
            <input type="radio" value="1" name="id">
        </div>
        <div class="col-3">
            <label>Комната 2</label>
            <input type="radio" value="2" name="id">
        </div>
        <div class="col-3">
            <label>Комната 3</label>
            <input type="radio" value="3" name="id">
        </div>
        <div class="col-3">
            <button type="submit">Go</button>
        </div>
    </form>
</div>
</body>
</html>
