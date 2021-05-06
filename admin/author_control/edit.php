<?php
require_once '../../php/db.php';
$id = $_POST['id'];
$fame = $_POST['fame'];
$name = $_POST['name'];
$otche = $_POST['otche'];
$opis = $_POST['opis'];
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
    move_uploaded_file($_FILES['img']['tmp_name'], '../../img/Authors/'.$_FILES['img']['name']);
}
if (!empty($_POST["chember"])) {
    mysqli_query($connect, "DELETE FROM `created` WHERE `id автора` ='$id'");
    foreach ($_POST["chember"] as $chember){
        mysqli_query($connect, "INSERT INTO `created`(`id мультфильма`, `id автора`) VALUE('$chember','$id')");
    }
}
if (!empty($_POST["chember1"])) {
    mysqli_query($connect, "DELETE FROM `car-aut` WHERE `id автора` ='$id'");
    foreach ($_POST["chember1"] as $chember1){
        mysqli_query($connect, "INSERT INTO `car-aut`(`id автора`, `id карьеры`) VALUE('$id','$chember1')");
    }
}
if ($priv == 2){
    mysqli_query($connect,"UPDATE `authors` SET `Фамилия` = '$fame', `Имя` = '$name', `Отчество` = '$otche', `Описание` = '$opis', `Изображение` = '$file_name' WHERE `id автора` =".$id);
    //header("Location: ../autors.php");
}