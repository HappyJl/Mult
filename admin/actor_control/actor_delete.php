<?php

include '../../php/db.php';

$id = $_GET['id'];
mysqli_query($connect, "DELETE FROM `voice-actors` WHERE `id актера` ='$id'");
mysqli_query($connect, "DELETE FROM `voice` WHERE `id актера` ='$id'");
unlink('../../img/Actors/' . $id . '.jpg');
header("Location: ../actor.php");
