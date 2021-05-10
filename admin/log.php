<?php
session_start();
$log = $_POST['log'];
$pas = $_POST['pas'];

if ($log == "Admin" && $pas == "Admin"){
    header("Location: main.php");
}else{
    $_SESSION['msg'] = "Неверный пароль или логин";
    header("Location: index.php");
}