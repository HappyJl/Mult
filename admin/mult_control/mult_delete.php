<?php
include '../../php/db.php';

$id = $_GET['id'];
echo $id;
mysqli_query($connect, "DELETE FROM `cartoon` WHERE `Id мультфильма` ='$id'");
header("Location: ../mult.php");
