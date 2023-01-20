<?php
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up or Register</title>
</head>
<body>

<p>Регистрация</p>


<form action="/createUser" method="post" name="registration">
    <p>Input Login</p>
    <input type="text" name="login" required><br>
    <p>Input Password</p>
    <input type="password" name="password" required><br>
    <input type="submit">
</form>
<?php
$error = $_SESSION["reg_error"] ?? null;
if ($error) {
    echo "<div>$error</div>";
}
unset($_SESSION['reg_error']);
?>
<p>Авторизация</p>
<form action="/auth" method="post" name="auth">
    <p>Input Login</p>
    <input type="text" name="login" required><br>
    <p>Input Password</p>
    <input type="password" name="password" required><br>
    <input type="submit">
</form>
<?php if (!empty($_SESSION['auth_error'])) {
    echo "<div>Auth error</div>";
}
unset($_SESSION['auth_error']);
?>
</body>
</html>
