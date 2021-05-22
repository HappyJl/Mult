<?php

require_once '../../php/db.php';

$mult = mysqli_query($connect, "SELECT * FROM `website`");
$mult2 = mysqli_query($connect, "SELECT * FROM `website`");
$total_mult = 0;
$numbr_mult = 0;
$prov = 0;
$name = $_POST['name'];
$id = 0;

while ($mult_res = mysqli_fetch_assoc($mult)) {
    if ($name == $mult_res['Название']) {
        echo "Данный сайт уже есть";
        break;
    } else {
        $numbr_mult = $mult_res['id сайта'];
    }
}
while ($mult_res = mysqli_fetch_assoc($mult2)) {
    $total_mult++;
}
if ($total_mult == $numbr_mult) {
    $id = $total_mult + 1;

    if ($name == null) {
        $error = "Введите название";
        echo $error;
    } else {
        $prov++;
    }

    if ($prov == 1) {
        mysqli_query($connect, "INSERT INTO `website` (`id сайта`, `Название`) VALUE ('$id','$name')");
        header("Location: web.php");
    }
}
echo $prov;
echo $total_mult;
echo $numbr_mult;
echo $id;
