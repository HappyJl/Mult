<?php
require_once '../../php/db.php';
$char = mysqli_query($connect, "SELECT * FROM `charecters`");
$name = $_POST['name'];
$opis = $_POST['opis'];
$numbr_mult = 0;
$total_mult = 0;
$prov = 0;
$id = 0;

$chek = 0;
while ($char_res = mysqli_fetch_assoc($char)) {
    if ($name == $char_res['Имя']) {
        echo "Данный персонаж уже есть в базе данных";
        $chek++;
        break;
    } else {
        $numbr_mult = $char_res['id персонажа'];
    }
}
if ($chek == 0){
    $id = $numbr_mult + 1;
    if ($name == null) {
        $error = "Введите имя";
        echo $error;
        //header("Location: char_add.php");
    } else {
        $prov++;
    }
    $_FILES['img']['name'] = $id . '.jpg';
    $file_name = $_FILES['img']['name'];
    if ($_FILES['img']['size'] == null) {
        echo "Добавьте картинку";
        header("Location: char_add.php");
    } else {
        $prov++;
    }
    if (!empty($_POST["chember1"])) {
        $prov++;
    }else {
        $error = "Выберите актера озвучивания";
        echo $error;
        header("Location: char_add.php");
    }
    if (!empty($_POST["chember2"])) {
        $prov++;
    }else {
        $error = "Выберите мультфильм";
        echo $error;
        header("Location: char_add.php");
    }
    if ($prov == 4){
        move_uploaded_file($_FILES['img']['tmp_name'], '../../img/Person/' . $_FILES['img']['name']);
        mysqli_query($connect, "INSERT INTO `charecters` (`id персонажа`, `Имя`,`Описание`,`Изображение`) VALUE ('$id','$name','$opis','$file_name')");
        $chember_one = $_POST["chember1"];
        mysqli_query($connect, "INSERT INTO `voice` (`id персонажа`, `id актера`) VALUE('$id','$chember_one')");
        foreach ($_POST["chember2"] as $chember_two){
            mysqli_query($connect, "INSERT INTO `participates`(`id мультфильма`, `id персонажа`) VALUE('$chember_two','$id')");
        }
        header("Location: char_add.php");
        exit;
    }
}