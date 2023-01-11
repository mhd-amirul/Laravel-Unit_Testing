<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/register" method="post">
        @csrf
        <div>
            <input type="text" name="name" id="" placeholder="name">
        </div>
        <div>
            <input type="text" name="email" id="" placeholder="email">
        </div>
        <div>
            <input type="password" name="password" id="" placeholder="password">
        </div>
        <div>
            <input type="password" name="confirmPassword" id="" placeholder="Konfirmasi password">
        </div>
        <button type="submit">Send</button>
    </form>
</body>
</html>
