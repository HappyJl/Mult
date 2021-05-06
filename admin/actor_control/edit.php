<?php
require_once '../../php/db.php';
$id = $_POST['id'];
$fame = $_POST['fame'];
$name = $_POST['name'];
$otche = $_POST['otche'];
$opis = $_POST['opis'];
$chember = $_POST["chember"];
$priv = 0;
$_FILES['img']['name'] = $id.'.jpg';
$file_name = $_FILES['img']['name'];
if ($fame == null){
    echo "Вы забыли указать фамилию";
}else{
    $priv++;
}
if ($name == null){
    echo "Вы забыли указать имя";
}else{
    $priv++;
}
if ($_FILES['img']['size'] != null){
    move_uploaded_file($_FILES['img']['tmp_name'], '../../img/Actors/'.$_FILES['img']['name']);
}
if ($chember != null){
    mysqli_query($connect, "DELETE FROM `voice` WHERE `id актера` ='$id'");
    mysqli_query($connect, "INSERT INTO `voice`(`id персонажа`, `id актера`) VALUE('$chember','$id')");
}
if ($priv == 2){
    mysqli_query($connect,"UPDATE `voice-actors` SET `Фамилия` = '$fame', `Имя` = '$name', `Отчество` = '$otche', `Описание` = '$opis', `Изображение` = '$file_name' WHERE `id актера` =".$id);
    header("Location: ../actor.php");
}