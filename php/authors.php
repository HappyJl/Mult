<?php
include 'db.php';
$result = mysqli_query($connect,"SELECT * FROM `authors`");
$let = $_GET['id'];

for ($i = 0; $i < $let; $i++){
    $authors = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../style/nav.css">
    <link rel="stylesheet" href="../style/authors.css">
    <link rel="stylesheet" href="../style/footer_authors.css">
    <link rel="stylesheet" href="../style/media.css">
</head>
<header>
    <div  id="logo">
    <l>Мульт</l>
    </div>
    <div class="category">
        <ul class="list">
            <li>
                <a href="filter_authors.php" class="font-main">Авторы</a>
                <ul>
                    <li><a href="filter_cartoon.php" class="font-sub">Мультфильмы</a></li>
                    <li><a href="filter_person.php" class="font-sub">Персонажи</a></li>
                    <li><a href="filter_voice.php" class="font-sub">Актеры</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="cont-form">
     <form action="filter_search_authors.php">
         <div>
         <input type="text" name="search" placeholder="Поиск" id="search-form">
         </div>
     </form>
    </div>
</header>

<body>
    <div id="name">
        <h4><?php echo $authors['Фамилия'];?> <?php echo $authors['Имя'];?> <?php echo $authors['Отчество'];?></h4>
    </div>
    <div class="pers">
        <h5 id="category">Автор мультфильма</h5>
        <img src="../img/Authors/<?php echo $authors['Изображение'] ?>" alt="" id="img">
    </div>

    <div class="block_actor">
        <div class="actor">
            <div class="actor-text-top">
            Карьера
            </div>
        </div>
        <div class="actor-text-bottom">
        <?php
        $result2 = mysqli_query($connect,"SELECT * FROM `car-aut` WHERE `id автора` =".$authors['id автора']);
        while ($cat_aut = mysqli_fetch_assoc($result2)){
            $result3 = mysqli_query($connect, "SELECT * FROM `career` WHERE `id карьеры` =".$cat_aut['id карьеры'] );
            $career = mysqli_fetch_assoc($result3);
            echo $career['Название'];?><br><?php
        }
        ?>
        </div>
    </div>

<div id="block_opis">
    <div class="opis">Описание</div>
    <span class="text"><?php echo $authors['Описание'];?></span>
</div>



<div id="footer">
        <div class="footer_name">
            <span> Мультфильмы</span>
        </div>
        <div>
            <?php
            $result4 = mysqli_query($connect, "SELECT * FROM `created` WHERE `id автора` =". $authors['id автора']);
            while($created = mysqli_fetch_assoc($result4)){
                $result5 = mysqli_query($connect, "SELECT * FROM `cartoon` WHERE `Id мультфильма` = ". $created['id мультфильма']);
                $cartoon = mysqli_fetch_assoc($result5);
                ?>
            <a href="mult.php?id=<?php echo $cartoon['Id мультфильма'];?>">
                <img src="../img/mult/<?php echo $cartoon['Изображение']?>" alt="" id="mult_img">
            </a>
            <?php
            }
            ?>
        </div>

</div>
</body>
</html>