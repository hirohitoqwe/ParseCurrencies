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
    <title>Document</title>
</head>
<body>

<div>
    <form action="/convert" method="post">
        <label for="TR">To Rubles:</label>
        <input name="count" type="number">
        <select name="TR" id="TR">
            <?php
            foreach ($data as $key => $currency){?>
                <option value="<?=$currency['letterCode']?>"><?=$currency['currencyName']?></option>";
            <?php }
            ?>
        </select>
        <input type="submit" value="Перевести">
    </form>
    Result: <?=$_SESSION['TRvalue'] ?? ""?>

    <form action="/convert" method="post">
        <label for="FR">From Rubles:</label>
        <input name="count" type="number">
        <select name="FR" id="FR">
            <?php
            foreach ($data as $key => $currency){?>
                <option value="<?=$currency['letterCode']?>"><?=$currency['currencyName']?></option>";
            <?php }
            ?>
        </select>
        <input type="submit" value="Перевести">
    </form>
    Result: <?=$_SESSION['FRvalue'] ?? ""?>
</div>

</body>
</html>