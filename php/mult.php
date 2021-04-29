<?php
//ini_set('display_errors', 0);
//ini_set('display_startup_errors', 0);
//error_reporting(E_ALL);
include 'db.php';
$result = mysqli_query($connect,"SELECT * FROM `cartoon`");
$let = $_GET['id'];

for ($i = 0; $i < $let; $i++){
   $cartoon = mysqli_fetch_assoc($result);

   $result1 = mysqli_query($connect,"SELECT * FROM `studio` WHERE `id студии` = ". $cartoon['id студии']);
   $studio = mysqli_fetch_array($result1);

   $res = mysqli_query($connect,"SELECT * FROM `country` WHERE `id страны` = ". $cartoon['Страна производитель']);
   $country = mysqli_fetch_assoc($res);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../style/nav.css">
    <link rel="stylesheet" href="../style/mult.css">
    <link rel="stylesheet" href="../style/footer_mult.css">
    <link rel="stylesheet" href="../style/media.css">
    <script src="https://kit.fontawesome.com/94f5867c6b.js" crossorigin="anonymous"></script>
    <link href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900" rel="stylesheet">
</head>
<header>
    <div  id="logo">
    <l>Мульт</l>
    </div>
    <div class="category">
        <ul class="list">
            <li>
                <a href="filter_cartoon.php" class="font-main">Мультфильм</a>
                <ul>
                    <li><a href="filter_person.php" class="font-sub">Персонажи</a></li>
                    <li><a href="filter_voice.php" class="font-sub">Актеры</a></li>
                    <li><a href="filter_authors.php" class="font-sub">Авторы</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="cont-form">
     <form action="filter_search_cartoon.php">
         <div>
         <input type="text" name="search" placeholder="Поиск" id="search-form">
         </div>
     </form>
    </div>
</header>

<body>
    <div id="name">
    <h4><?php echo $cartoon['Название'];?></h4>
    </div>
    <div class="pers">
        <h5 id="category">Мультфильм</h5>
        <img src="../img/mult/<?php echo $cartoon['Изображение'] ?>" alt="" id="img">
    </div>

    <div id="block_info">
        <div class="info">Информация</div>
        <div class="info_text">
            <div class="info_dec"><b>Количество эпизодов: </b><?php echo $cartoon['Количество эпизодов'] ?></div>
            <div class="info_dec"><b>Продолжительность: </b><?php echo $cartoon['Прод. эпиз.'] ?></div>
            <div class="info_dec"><b>Год выпуска: </b><?php echo $cartoon['Год выпуска'] ?></div>
            <div class="info_dec"><b>Страна производитель: </b><?php echo $country['Страна'] ?></div>
            <div class="info_dec"><b>Возрастной рейтинг: </b><?php echo $cartoon['Возрастной рейтинг'] ?></div>
            <div class="info_dec"><b>Рейтинг мультфильма: </b><?php echo $cartoon['Рейтинг мультфильма'] ?></div>
            <div class="info_dec"><b>Жанры:</b>
                <?php
                $result2 = mysqli_query($connect, "SELECT * FROM `keeping` WHERE `id мультфильма` =". $cartoon['Id мультфильма']);
                while($keeping = mysqli_fetch_assoc($result2)){
                    $result3 = mysqli_query($connect, "SELECT * FROM `genre` WHERE `id жанра` =".$keeping['id жанра'] );
                    $genre = mysqli_fetch_assoc($result3);
                    echo $genre['Название'].", ";
                }
                ?></div>
            <div class="info_dec"><b>Студия: </b><?php echo $studio['Название'] ?></div>
        </div>
    </div>
    <div id="block_opis">
        <div class="opis">Описание</div>
        <span class="text"><?php echo $cartoon['Описание'] ?></span>
    </div>



<div id="footer">
        <div class="footer_name">
            <span><a href="all_person.php?id=<?php echo $cartoon['Id мультфильма']?>">Персонажи</a></span>
        </div>
    <?php
    $result6 = mysqli_query($connect, "SELECT * FROM `participates` WHERE `id мультфильма` =". $cartoon['Id мультфильма']);
    for($g = 0; $g < 2; $g++){
        $parti = mysqli_fetch_assoc($result6);
        $result7 = mysqli_query($connect, "SELECT * FROM `charecters`  WHERE `id персонажа` =".$parti['id персонажа']);
        $person = mysqli_fetch_assoc($result7);
        ?>
        <div class="mult">
            <div class="mult_img">
                <a href="pers.php?id=<?php echo $person['id персонажа']?>">
                    <img src="../img/Person/<?php echo $person['Изображение'] ?>" alt="">
                </a>
            </div>
            <div class="mult_name_person">
                <?php echo $person['Имя']?>
            </div>
        </div>
        <?php
    }
    ?>
</div>
<div id="footer2">
        <div class="footer_name2">
            <span><a href="all_authors.php?id=<?php echo $cartoon['Id мультфильма']?>">Авторы</a></span>
        </div>
            <?php
            $result4 = mysqli_query($connect, "SELECT * FROM `created` WHERE `id мультфильма` =". $cartoon['Id мультфильма']);
            for($i = 0; $i < 2; $i++){
                $created = mysqli_fetch_assoc($result4);
                $result5 = mysqli_query($connect, "SELECT * FROM `authors`  WHERE `id автора` =".$created['id автора']);
                $authors = mysqli_fetch_assoc($result5);
            ?>
                <div class="mult">
                    <div class="mult_img">
                        <a href="authors.php?id=<?php echo $authors['id автора'];?>">
                        <img src="../img/Authors/<?php echo $authors['Изображение'] ?>" alt="">
                        </a>
                    </div>
                    <div class="mult_name_authors">
                        <?php echo $authors['Фамилия']?>
                        <?php echo $authors['Имя']?>
                        <?php echo $authors['Отчество']?>
                    </div>
                </div>
            <?php
            }
            ?>
</div>
</body>
</html>