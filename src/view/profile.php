<?php
$db = new \DB\DB();

$user = $db->getUserData($_SESSION["auth"]);


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <title>Личный кабинет</title>
</head>
<body>

<div>
    Здравствуйте, <?= $user->name ?>
</div>

<a href="profile/converter">Конвертер валют</a>
</body>
</html>