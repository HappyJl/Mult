<?php
require_once '../../php/db.php';

$mult = mysqli_query($connect, "SELECT * FROM `cartoon`");
$numbr_mult = 0;
$total_mult = 0;
$prov = 0;
$name = $_POST['name'];
$kolv_ep = $_POST['kolv_ep'];
$prod_ep = $_POST['prod_ep'];
$voz_rait = $_POST['voz_rait'];
$year = $_POST['year'];
$stran = $_POST['stran'];
$opis = $_POST['opis'];
$rait_mult = $_POST['rait_mult'];
$stud = $_POST['stud'];

$chek = 0;
while ($mult_res = mysqli_fetch_assoc($mult)) {
    if ($name == $mult_res['Название']){
        echo "Данный мультфильм есть в базе данных";
        $chek++;
        break;
    }else{
        $numbr_mult = $mult_res['Id мультфильма'];
    }
}

if ($chek == 0){
    $id = $numbr_mult + 1;
    if ($name == null) {
        $error = "Введите название";
        //header("Location: mult_add.php");
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
        $prov++;
    }else if($rait_mult >= 11 || $rait_mult < 0){
        echo "lox";
        header("Location: mult_add.php");
    }else{
        $prov++;
    }
    if ($opis == null){
        $opis = 0;
    }
    if (!empty($_POST["chember"])) {
        $prov++;
    } else {
        echo "Выберите жанр";
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
    if ($prov == 4) {
        move_uploaded_file($_FILES['img']['tmp_name'], '../../img/mult/'.$_FILES['img']['name']);
        mysqli_query($connect, "INSERT INTO `cartoon` (`Id мультфильма`, `Название`,`Количество эпизодов`,`Прод. эпиз.`,`Возрастной рейтинг`,`Год выпуска`,`Страна производитель`,`Описание`,`Рейтинг мультфильма`,`Изображение`,`id студии`)
    VALUE ('$id','$name','$kolv_ep','$prod_ep','$voz_rait','$year','$stran','$opis','$rait_mult','$file_name','$stud')");
        foreach ($_POST["chember"] as $chember){
            echo $chember;
            mysqli_query($connect, "INSERT INTO `keeping`(`id мультфильма`, `id жанра`) VALUE('$id','$chember')");
        }
        header("Location: mult_add.php");
    }
}else{
    echo "Сломалось";
}
