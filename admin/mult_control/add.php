<?php
require_once '../../php/db.php';

$mult = mysqli_query($connect, "SELECT * FROM `cartoon`");
$total_mult = 0;
$prov = 0;

while ($mult_res = mysqli_fetch_assoc($mult)) {
    $total_mult++;
}

$id = $total_mult + 1;
$name = $_POST['name'];
$kolv_ep = $_POST['kolv_ep'];
$prod_ep = $_POST['prod_ep'];
$voz_rait = $_POST['voz_rait'];
$year = $_POST['year'];
$stran = $_POST['stran'];
$opis = $_POST['opis'];
$rait_mult = $_POST['rait_mult'];
$stud = $_POST['stud'];

if ($name == null) {
    $error = "Введите название";
    header("Location: mult_add.php");
} else {
    $prov++;
}
if ($kolv_ep == null) {
    $kolv_ep = 0;
}
if ($prod_ep == null) {
    $prod_ep = 0;
}
if ($voz_rait == null) {
    $voz_rait = 0;
}
if ($year == null) {
    $year = 0;
}
if ($rait_mult == null) {
    $rait_mult = 0;
}else if($rait_mult >= 11){
    header("Location: mult_add.php");
}else{
    $prov++;
}
if ($opis == null){
    $opis = 0;
}

$_FILES['img']['name'] = $id.'.jpg';
$file_name = $_FILES['img']['name'];
if ($_FILES['img']['size'] == null){
    echo "Добавьте картинку";
    header("Location: mult_add.php");
}else{
    echo "Скопирован";
    $prov++;
}

echo $prov;

if ($prov == 3) {
    move_uploaded_file($_FILES['img']['tmp_name'], '../../img/mult/'.$_FILES['img']['name']);
    mysqli_query($connect, "INSERT INTO `cartoon` (`Id мультфильма`, `Название`,`Количество эпизодов`,`Прод. эпиз.`,`Возрастной рейтинг`,`Год выпуска`,`Страна производитель`,`Описание`,`Рейтинг мультфильма`,`Изображение`,`id студии`)
    VALUE ('$id','$name','$kolv_ep','$prod_ep','$voz_rait','$year','$stran','$opis','$rait_mult','$file_name','$stud')");
    header("Location: mult_add.php");
}
