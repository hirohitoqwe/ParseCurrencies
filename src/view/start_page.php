<?php
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/createUser" method="post">
        <p>Input Login</p>
        <input type="text" name="login"><br>
        <p>Input Password</p>
        <input type="password" name="password"><br>
        <input type="submit">
    </form>

    Войти
    
    <form action="/auth" method="post">
        <p>Input Login</p>
        <input type="text" name="login"><br>
        <p>Input Password</p>
        <input type="password" name="password"><br>
        <input type="submit">
    </form>

</body>
</html>
