<?php
include 'db.php';
$forms_page = 20;
$page = 1;

if(isset($_GET['page'])){
    $page = (int) $_GET['page'];
}

$total_count_forms = mysqli_query($connect, "SELECT COUNT(`id автора`) AS  `total_count` FROM `authors`");
$total_count = mysqli_fetch_assoc($total_count_forms)['total_count'];
$total_pages = ceil($total_count / $forms_page);

if($page <= 1 || $page > $total_pages){
    $page = 1;
}

$offset = ($forms_page * $page) - $forms_page;