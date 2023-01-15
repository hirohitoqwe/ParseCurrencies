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
    <label for="cars">Choose first currencies:</label>

    <select name="cars" id="cars">
        <?php
        foreach ($data as $key => $currency){?>
            <option value="<?=$currency['letterCode']?>"><?=$currency['letterCode']?><?=$currency['currencyName']?></option>";
        <?php }
        ?>
    </select>


    <label for="cars">Choose second currencies:</label>

    <select name="cars" id="cars">
        <?php
        foreach ($data as $key => $currency){?>
            <option value="<?=$currency['letterCode']?>"><?=$currency['letterCode']?><?=$currency['currencyName']?></option>";
        <?php }
        ?>
    </select>
</div>

</body>
</html>
