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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <title>Личный кабинет</title>
</head>
<body>
<a href="/profile">Личный кабинет</a>
<div>
    <form action="/convert" method="post">
        <label for="TR">To Rubles:</label>
        <input name="count" type="number" required>
        <select name="TR" id="TR">
            <?php
            foreach ($data as $key => $currency) {
                ?>
                <option value="<?= $currency['letterCode'] ?>"><?= $currency['currencyName'] ?></option>";
            <?php }
            ?>
        </select>
        <input type="submit" value="Перевести">
    </form>


    <form action="/convert" method="post">
        <label for="FR">From Rubles:</label>
        <input name="count" type="number" required>
        <select name="FR" id="FR">
            <?php
            foreach ($data as $key => $currency) {
                ?>
                <option value="<?= $currency['letterCode'] ?>"><?= $currency['currencyName'] ?></option>";
            <?php }
            ?>
        </select>
        <input type="submit" value="Перевести">
    </form>
    <div>
        <div id="result">
        </div>

        <script>
            $(document).ready(function () {
                $('form').submit(function (event) {
                    event.preventDefault();
                    var $form = $(this);
                    $.ajax({
                        url: $form.attr('action'),
                        type: $form.attr('method'),
                        data: $form.serialize(),
                        dataType: "json",
                        success: function (result) {
                            var element = document.getElementById('result');
                            element.innerText=`Результат : ${result}`;
                        }
                    })
                });
            });
        </script>

</body>
</html>