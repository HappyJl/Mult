<?php
require_once '../../php/db.php';
$genre = mysqli_query($connect,"SELECT * FROM `genre`");
$name = $_POST['name'];
$prov = 0;
$id = 0;
$chek = 0;
$numbr_mult = 0;

while ($genre_res = mysqli_fetch_assoc($genre)){
    if ($name == $genre_res['Название']){
        echo "Данный жанр уже есть в базе данных";
        $chek++;
        break;
    }else{
        $numbr_mult = $genre_res['id жанра'];
    }
}
if ($chek == 0){
    $id = $numbr_mult + 1;
    if ($name == null){
        $error = "Не указано название жанра";
        echo $error;
    }else{
        $prov++;
    }
    if ($prov == 1){
        mysqli_query($connect,"INSERT INTO `genre`(`id жанра`,`Название`) VALUE ('$id','$name')");
    }
}