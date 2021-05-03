<?php
require_once '../../php/db.php';

$mult = mysqli_query($connect, "SELECT * FROM `country`");
$mult2 = mysqli_query($connect, "SELECT * FROM `country`");
$total_mult = 0;
$numbr_mult = 0;
$prov = 0;
$name = $_POST['name'];
$id = 0;

while ($mult_res = mysqli_fetch_assoc($mult)) {
    if ($name == $mult_res['Страна']){
        echo "Данная страна уже есть в базе данных";
        break;
    }else{
        $numbr_mult = $mult_res['id страны'];
    }
}
while ($mult_res = mysqli_fetch_assoc($mult2)){
    $total_mult++;
}
if ($total_mult == $numbr_mult){
    $id = $total_mult + 1;

    if ($name == null) {
        $error = "Введите название";
        echo $error;
    } else {
        $prov++;
    }

    if ($prov == 1) {
        mysqli_query($connect, "INSERT INTO `country` (`id страны`, `Страна`) VALUE ('$id','$name')");
        //header("Location: stran.php");
    }
}
echo $prov;
echo $total_mult;
echo $numbr_mult;
echo $id;
