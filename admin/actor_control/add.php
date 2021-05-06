<?php
require_once '../../php/db.php';

$actor = mysqli_query($connect, "SELECT * FROM `voice-actors`");
$numbr_mult = 0;
$total_mult = 0;
$prov = 0;
$fame = $_POST['fame'];
$name = $_POST['name'];
$otche = $_POST['otche'];
$opis = $_POST['opis'];
$id = 0;

$chek = 0;
while ($actor_res = mysqli_fetch_assoc($actor)) {
    if ($fame == $actor_res['Фамилия'] && $name == $actor_res['Имя'] && $otche == $actor_res['Отчество']) {
        echo "Данный актер озвучки уже есть в базе данных";
        $chek++;
        break;
    } else {
        $numbr_mult = $actor_res['id актера'];
    }
}

if ($chek == 0) {
    $id = $numbr_mult + 1;
    if ($fame == null) {
        $error = "Введите фамилию";
        echo $error;
        //header("Location: actor_add.php");
    } else {
        $prov++;
    }
    if ($name == null) {
        $error = "Введите имя";
        echo $error;
    } else {
        $prov++;
    }
    if ($opis == null) {
        $opis = 0;
    }
    if (!empty($_POST["chember"])) {
        $prov++;
    } else {
        $error = "Выберите персонажа";
        echo $error;
    }


    $_FILES['img']['name'] = $id . '.jpg';
    $file_name = $_FILES['img']['name'];
    if ($_FILES['img']['size'] == null) {
        echo "Добавьте картинку";
        //header("Location: actor_add.php");
    } else {
        echo "Скопирован";
        $prov++;
    }
    if ($prov == 4) {
        move_uploaded_file($_FILES['img']['tmp_name'], '../../img/Actors/' . $_FILES['img']['name']);
        mysqli_query($connect, "INSERT INTO `voice-actors` (`id актера`, `Фамилия`,`Имя`,`Отчество`,`Описание`,`Изображение`) VALUE ('$id','$fame','$name','$otche','$opis','$file_name')");
        $chember = $_POST["chember"];
        echo $chember;
        mysqli_query($connect, "INSERT INTO `voice`(`id персонажа`, `id актера`) VALUE('$chember','$id')");

        header("Location: actor_add.php");
    }
} else {
    echo "Сломалось";
}

