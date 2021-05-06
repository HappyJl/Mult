<?php
require_once '../../php/db.php';
$id = $_POST['id'];
$name = $_POST['name'];
$opis = $_POST['opis'];
$chember1 = $_POST['chember1'];
$priv = 0;

$_FILES['img']['name'] = $id.'.jpg';
$file_name = $_FILES['img']['name'];

if ($name == null){
    echo "Вы забыли указать имя";
}else{
    $priv++;
}
if ($_FILES['img']['size'] != null){
    move_uploaded_file($_FILES['img']['tmp_name'], '../../img/Person/'.$_FILES['img']['name']);
}
if ($chember1 != null){
    mysqli_query($connect, "DELETE FROM `voice` WHERE `id персонажа` ='$id'");
    mysqli_query($connect, "INSERT INTO `voice`(`id персонажа`, `id актера`) VALUE('$id','$chember1')");
}
if (!empty($_POST["chember2"])) {
    mysqli_query($connect, "DELETE FROM `participates` WHERE `id персонажа` ='$id'");
    foreach ($_POST["chember2"] as $chember2){
        echo $chember2;
        mysqli_query($connect, "INSERT INTO `participates`(`id мультфильма`, `id персонажа`) VALUE('$chember2','$id')");
    }
}
if ($priv == 1){
    mysqli_query($connect,"UPDATE `charecters` SET `Имя` = '$name', `Описание` = '$opis', `Изображение` = '$file_name' WHERE `id персонажа` =".$id);
    header("Location: ../char.php");
}