<?php
include '../../php/db.php';

$id = $_GET['id'];
mysqli_query($connect, "DELETE FROM `charecters` WHERE `id персонажа` ='$id'");
mysqli_query($connect, "DELETE FROM `participates` WHERE `id персонажа` ='$id'");
mysqli_query($connect, "DELETE FROM `voice` WHERE `id персонажа` ='$id'");
unlink('../../img/Person/' . $id . '.jpg');
header("Location: ../char.php");
