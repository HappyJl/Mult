<?php
include '../../php/db.php';

$id = $_GET['id'];
mysqli_query($connect, "DELETE FROM `cartoon` WHERE `Id мультфильма` ='$id'");
mysqli_query($connect, "DELETE FROM `keeping` WHERE `id мультфильма` ='$id'");
unlink('../../img/mult/'.$id.'.jpg');
header("Location: ../mult.php");