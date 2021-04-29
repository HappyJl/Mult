<?php
include 'db.php';
$result = mysqli_query($connect,"SELECT * FROM `charecters`");
$let = $_GET['id'];

for ($i = 0; $i < $let; $i++){
    $persona = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../style/nav.css">
    <link rel="stylesheet" href="../style/body.css">
    <link rel="stylesheet" href="../style/footer.css">
    <link rel="stylesheet" href="../style/media.css">
</head>
<header>
    <div  id="logo">
    <l>Мульт</l>
    </div>
    <div class="category">
        <ul class="list">
            <li>
                <a href="filter_person.php" class="font-main">Персонажи</a>
                <ul>
                    <li><a href="filter_cartoon.php" class="font-sub">Мультфильмы</a></li>
                    <li><a href="filter_voice.php" class="font-sub">Актеры</a></li>
                    <li><a href="filter_authors.php" class="font-sub">Авторы</a></li>
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
    <div class="pers">
        <h4 id="name"><?php echo $persona['Имя']?></h4>
        <h4 id="category">Персонаж мультфильма</h4>
        <img src="../img/Person/<?php echo $persona['Изображение']?>" alt="" id="img">
    </div>

    <div id="block_actor">
        <span class="actor">Актер озвучания</span>
        <?php
        $result4 = mysqli_query($connect, "SELECT * FROM `voice` WHERE `id персонажа` =". $persona['id персонажа']);
        for($i =0; $i < 1; $i++){
            $voice = mysqli_fetch_assoc($result4);
            $result5 = mysqli_query($connect, "SELECT * FROM `voice-actors`  WHERE `id актера` =". $voice['id актера']);
            $voice_actor = mysqli_fetch_assoc($result5);
            ?>
            <div>
                <a href="actor.php?id=<?php echo $voice_actor['id актера']?>"><img src="../img/Actors/<?php echo $voice_actor['Изображение']?>" alt="" id="actor_img"></a>
                <div class="actor_text"><?php echo $voice_actor['Фамилия']?> <?php echo $voice_actor['Имя']?></div>
            </div>
        <?php
        }
        ?>
    </div>

<div id="block_opis">
    <div class="opis">Описание</div>
    <span class="text"><?php echo $persona['Описание']?></span>
</div>



<div id="footer">
        <div class="footer_name">
            <span> Мультфильмы</span>
        </div>
        <div>
            <?php
            $result2 = mysqli_query($connect, "SELECT * FROM `participates` WHERE `id персонажа` =". $persona['id персонажа']);
            while($part = mysqli_fetch_assoc($result2)){
                $result3 = mysqli_query($connect, "SELECT * FROM `cartoon` WHERE `Id мультфильма` = ". $part['id мультфильма']);
                $cartoon = mysqli_fetch_assoc($result3);
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