<?php
include 'db.php';
$let = $_GET['id'];
$result = mysqli_query($connect, "SELECT * FROM `voice-actors` WHERE `id актера`=" . $let);
$voice_actor = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../style/nav.css">
    <link rel="stylesheet" href="../style/actors.css">
    <link rel="stylesheet" href="../style/footer_actor.css">
    <link rel="stylesheet" href="../style/media.css">

</head>
<header>
    <div id="logo">
        <l>Мульт</l>
    </div>
    <div class="category">
        <ul class="list">
            <li>
                <a href="filter_voice.php" class="font-main">Актеры</a>
                <ul>
                    <li><a href="filter_cartoon.php" class="font-sub">Мультфильмы</a></li>
                    <li><a href="filter_person.php" class="font-sub">Персонажи</a></li>
                    <li><a href="filter_authors.php" class="font-sub">Авторы</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="cont-form">
        <form action="filter_search_voice.php">
            <div>
                <input type="text" name="search" placeholder="Поиск" id="search-form">
            </div>
        </form>
    </div>
</header>

<body>
<div id="name">
    <h4><?php echo $voice_actor['Фамилия']; ?> <?php echo $voice_actor['Имя']; ?> <?php echo $voice_actor['Отчество']; ?></h4>
</div>
<div class="pers">
    <h4 id="category">Актер озвучания</h4>
    <img src="../img/Actors/<?php echo $voice_actor['Изображение'] ?>" alt="" id="img">
</div>

<div id="block_actor">
    <div class="actor"><span class="actor_text">Персонаж</span></div>
    <?php
    $char = 0;
    $i = 0;
    $result2 = mysqli_query($connect, "SELECT * FROM `voice` WHERE `id актера` =" . $voice_actor['id актера']);
    while ($voice = mysqli_fetch_assoc($result2)) {
            $result3 = mysqli_query($connect, "SELECT * FROM `charecters`  WHERE `id персонажа` =" . $voice['id персонажа']);
            $char = mysqli_fetch_assoc($result3);
            $i++;
            if ($i > 1){
                break;
            }
            ?>
            <div>
                <a href="pers.php?id=<?php echo $char['id персонажа'] ?>"><img
                            src="../img/Person/<?php echo $char['Изображение'] ?>" alt="" id="actor_img"></a>
            </div>
            <?php
    }
    ?>
</div>

<div id="block_opis">
    <div class="opis">Описание</div>
    <span class="text"><?php echo $voice_actor['Описание'] ?></span>
</div>


<div id="footer">
    <div class="footer_name">
        <span> Мультфильмы</span>
    </div>
    <div>
        <?php
        if ($char == null) {

        } else {
            $result4 = mysqli_query($connect, "SELECT * FROM `participates` WHERE `id персонажа` =" . $char['id персонажа']);
            while ($part = mysqli_fetch_assoc($result4)) {
                $result5 = mysqli_query($connect, "SELECT * FROM `cartoon` WHERE `Id мультфильма` = " . $part['id мультфильма']);
                $cartoon = mysqli_fetch_assoc($result5);
                ?>
                <a href="mult.php?id=<?php echo $cartoon['Id мультфильма']; ?>">
                    <img src="../img/mult/<?php echo $cartoon['Изображение'] ?>" alt="" id="mult_img">
                </a>
                <?php
            }
        }

        ?>
    </div>

</div>
</body>
</html>