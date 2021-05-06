<?php
include 'db.php';
$result = mysqli_query($connect,"SELECT * FROM `cartoon`");
$let = $_GET['id'];

for ($i = 0; $i < $let; $i++){
    $cartoon = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../style/nav.css">
    <link rel="stylesheet" href="../style/all_authors.css">
    <link rel="stylesheet" href="../style/footer_all_authors.css">
    <link href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900" rel="stylesheet">
</head>
<header>
    <div  id="logo">
    Мульт
    </div>
    <div class="category">
        <ul class="list">
            <li>
                <a href="filter_person.php" class="font-main">Персонажи</a>
                <ul>
                    <li><a href="filter_cartoon.php" class="font-sub">Мультфильмы</a></li>
                    <li><a href="filter_authors.php" class="font-sub">Авторы</a></li>
                    <li><a href="filter_voice.php" class="font-sub">Актеры</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="cont-form">
     <form action="filter_search_pers.php">
         <div>
         <input type="text" name="search" placeholder="Поиск" id="search-form">
         </div>
     </form>
    </div>
</header>

<body>

<div id="filter-box">
        <div class="filter_name">
            <span>Персонажи</span>
        </div>

        <div class="mult-block">
            <?php
            $result1 = mysqli_query($connect,"SELECT * FROM `participates` WHERE `id мультфильма` =". $cartoon['Id мультфильма']);
            while($parti = mysqli_fetch_assoc($result1)){
                $result2 = mysqli_query($connect, "SELECT * FROM `charecters` WHERE `id персонажа` =".$parti['id персонажа'] );
                $person = mysqli_fetch_assoc($result2);
            ?>
            <div class="mult">
                <div class="mult_img">
                    <a href="pers.php?id=<?php echo $person['id персонажа'];?>"><img src="../img/Person/<?php echo $person['Изображение'] ?>" alt=""></a>
                </div>
                <div>
                    <div class="mult_opis">
                        <?php echo $person['Имя'];?>
                    </div>
                </div>
            </div>
                <?php
            }
            ?>
        </div>
    <div class="page">

    </div>
</div>

</body>
</html>