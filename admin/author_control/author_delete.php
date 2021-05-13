<?php

include '../../php/db.php';

$id = $_GET['id'];
mysqli_query($connect, "DELETE FROM `authors` WHERE `id автора` ='$id'");
mysqli_query($connect, "DELETE FROM `created` WHERE `id автора` ='$id'");
mysqli_query($connect, "DELETE FROM `car-aut` WHERE `id автора` ='$id'");
unlink('../../img/Authors/' . $id . '.jpg');
header("Location: ../autors.php");
