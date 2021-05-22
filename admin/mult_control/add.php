<?php
require_once '../../php/db.php';
session_start();
$_SESSION['msg'] = '';
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
        $_SESSION['msg'] = "Ошибка: Данный мультфильм есть в базе данных";
        $chek++;
        break;
    }else{
        $numbr_mult = $mult_res['Id мультфильма'];
    }
}

if ($chek == 0){
    $id = $numbr_mult + 1;
    if ($name == null) {
        $_SESSION['msg'] = "Ошибка: Введите название мультфильма";
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
        $prov++;
    }else if($rait_mult >= 11 || $rait_mult < 0){
        $_SESSION['msg'] = "Ошибка: Введите рейтинг в диапазоне от 0 до 10";
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
        $_SESSION['msg'] = "Ошибка: Выберите жанр мультфильма";
        header("Location: mult_add.php");
    }

    $_FILES['img']['name'] = $id.'.jpg';
    $file_name = $_FILES['img']['name'];
    if ($_FILES['img']['size'] == null){
        $_SESSION['msg'] = "Ошибка: Добавте картинку";
        header("Location: mult_add.php");
    }else{
        $prov++;
    }
    if ($prov == 4) {
        move_uploaded_file($_FILES['img']['tmp_name'], '../../img/mult/'.$_FILES['img']['name']);
        mysqli_query($connect, "INSERT INTO `cartoon` (`Id мультфильма`, `Название`,`Количество эпизодов`,`Прод. эпиз.`,`Возрастной рейтинг`,`Год выпуска`,`Страна производитель`,`Описание`,`Рейтинг мультфильма`,`Изображение`,`id студии`)
    VALUE ('$id','$name','$kolv_ep','$prod_ep','$voz_rait','$year','$stran','$opis','$rait_mult','$file_name','$stud')");
        foreach ($_POST["chember"] as $chember){
            mysqli_query($connect, "INSERT INTO `keeping`(`id мультфильма`, `id жанра`) VALUE('$id','$chember')");
        }
        if (!empty($_POST["chember1"])) {
            foreach ($_POST["chember1"] as $chember1){
                mysqli_query($connect, "INSERT INTO `watch`(`id мультфильма`, `id сайта`) VALUE('$id','$chember1')");
            }
        }
        header("Location: mult_add.php");
        $_SESSION['msg'] = "Мультфильм добавлен";
    }
}else{
    header("Location: mult_add.php");
    echo "Сломалось";
}

