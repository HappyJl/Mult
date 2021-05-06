<?php
require_once '../../php/db.php';
$id = $_POST['id'];
$name = $_POST['name'];
$kolv_ep = $_POST['kolv_ep'];
$prod_ep = $_POST['prod_ep'];
$voz_rait = $_POST['voz_rait'];
$year = $_POST['year'];
$stran = $_POST['stran'];
$opis = $_POST['opis'];
$rait_mult = $_POST['rait_mult'];
$stud = $_POST['stud'];
$priv = 0;
$_FILES['img']['name'] = $id.'.jpg';
$file_name = $_FILES['img']['name'];


if ($name == null){
    echo "Вы забыли указать название";
}else{
    $priv++;
}
if ($_FILES['img']['size'] != null){
    move_uploaded_file($_FILES['img']['tmp_name'], '../../img/mult/'.$_FILES['img']['name']);
}
if (!empty($_POST["chember"])) {
    mysqli_query($connect, "DELETE FROM `keeping` WHERE `id мультфильма` ='$id'");
    foreach ($_POST["chember"] as $chember){
        echo $chember;
        mysqli_query($connect, "INSERT INTO `keeping`(`id мультфильма`, `id жанра`) VALUE('$id','$chember')");
    }
}

if ($priv == 1){
    mysqli_query($connect,"UPDATE `cartoon` SET `Название` = '$name', `Количество эпизодов` = '$kolv_ep', `Прод. эпиз.` = '$prod_ep', `Возрастной рейтинг` = '$voz_rait', `Год выпуска` = '$year', `Страна производитель` = '$stran', `Описание` = '$stran', `Описание` = '$opis', `Рейтинг мультфильма` = '$rait_mult', `Изображение` = '$file_name', `id студии` = '$stud' WHERE `Id мультфильма` =".$id);
    header("Location: ../mult.php");
}