<?php

$db = new \DB\DB();

$data = $db->getCurrenciesData();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
<a href="/profile">Личный кабинет</a>
<table cellpadding="4">
    <thead>
    <tr>
        <td>Цифр.код</td>
        <td>Букв.код</td>
        <td>Валюта</td>
        <td>Курс</td>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($data as $key => $currency) {
        ?>
        <tr>
            <td><?= $currency['numCode'] ?></td>
            <td><?= $currency['letterCode'] ?></td>
            <td><?= $currency['currencyName'] ?></td>
            <td><?= $currency['course'] ?></td>
        </tr>
    <?php }
    ?>
    </tbody>
</table>

</body>

</html>