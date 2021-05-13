<?php
require_once '../../php/db.php';

$author = mysqli_query($connect, "SELECT * FROM `authors`");
$numbr_mult = 0;
$total_mult = 0;
$prov = 0;
$fame = $_POST['fame'];
$name = $_POST['name'];
$otche = $_POST['otche'];
$opis = $_POST['opis'];
$id = 0;

$chek = 0;
while ($author_res = mysqli_fetch_assoc($author)) {
    if ($fame == $author_res['Фамилия'] && $name == $author_res['Имя'] && $otche == $author_res['Отчество']) {
        $chek++;
        break;
    } else {
        $numbr_mult = $author_res['id автора'];
    }
}

if ($chek == 0) {
    $id = $numbr_mult + 1;
    if ($fame == null) {
        header("Location: author_add.php");
    } else {
        $prov++;
    }
    if ($name == null) {
        header("Location: author_add.php");
    } else {
        $prov++;
    }
    if ($opis == null) {
        $opis = 0;
        header("Location: author_add.php");
    }
    if (!empty($_POST["chember"])) {
        $prov++;
    } else {
        header("Location: author_add.php");
    }
    if (!empty($_POST["chember1"])) {
        $prov++;
    } else {
        header("Location: author_add.php");
    }


    $_FILES['img']['name'] = $id . '.jpg';
    $file_name = $_FILES['img']['name'];
    if ($_FILES['img']['size'] == null) {
        header("Location: author_add.php");
    } else {
        $prov++;
    }
    if ($prov == 5) {
        move_uploaded_file($_FILES['img']['tmp_name'], '../../img/Authors/' . $_FILES['img']['name']);
        mysqli_query($connect, "INSERT INTO `authors` (`id автора`, `Фамилия`,`Имя`,`Отчество`,`Описание`,`Изображение`) VALUE ('$id','$fame','$name','$otche','$opis','$file_name')");

        foreach ($_POST["chember"] as $chember){
            mysqli_query($connect, "INSERT INTO `created`(`id мультфильма`, `id автора`) VALUE('$chember','$id')");
        }
        foreach ($_POST["chember1"] as $chember1){
            mysqli_query($connect, "INSERT INTO `car-aut`(`id автора`, `id карьеры`) VALUE('$id','$chember1')");
        }

        header("Location: author_add.php");
    }
} else {

}

