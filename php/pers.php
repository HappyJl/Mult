<?php
include 'db.php';
$let = $_GET['id'];
$result = mysqli_query($connect, "SELECT * FROM `charecters` WHERE `id персонажа`=" . $let);
$persona = mysqli_fetch_assoc($result);
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
    <div id="logo">
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
<div class="mult_name"><?php echo $persona['Имя'] ?></div>

<div class="content">
    <div class="mult_info"><img class="mult_image" src="../img/Person/<?php echo $persona['Изображение'] ?>" alt="">
    </div>
    <div class="mult_info_info">
        <div class="text_info">Информация</div>
        <div class="opis_text"><?php echo $persona['Описание'] ?></div>
    </div>
    <div class="mult_info_watch">
        <a href=""><div class="text_watch">Актер озвучивания</div></a>
        <?php
        $i = 0;
        $voice = mysqli_query($connect, "SELECT * FROM `voice` WHERE `id персонажа`=" . $persona['id персонажа']);
        while ($voice_res = mysqli_fetch_assoc($voice)) {
            if ($voice_res == null) {
                echo "Нет актера озвучания";
            } else {
                $i++;
                $actor = mysqli_query($connect, "SELECT * FROM `voice-actors` WHERE `id актера`=" . $voice_res['id актера']);
                $actor_res = mysqli_fetch_assoc($actor);
                if ($i > 1){
                    break;
                }
                ?>
                <a href="actor.php?id=<?php echo $actor_res['id актера']?>">
                    <div class="outside">
                        <div class="mult_info"><img class="mult_image" src="../img/Actors/<?php echo $actor_res['Изображение']?>" alt=""></div>
                        <div><?php echo $actor_res['Фамилия']." ". $actor_res['Имя']?></div>
                    </div>
                </a>
                <?php
            }
        }
        ?>

    </div>
</div>
<div class="footer">
    <div class="mult_char">
            <div class="mult_char_text">Мультфильмы</div>
        <?php
        $result6 = mysqli_query($connect, "SELECT * FROM `participates` WHERE `id персонажа` =" . $persona['id персонажа']);

        while ($id_pers = mysqli_fetch_assoc($result6)) {
            if ($id_pers == null) {
                echo 'Мультфильмов пока нет';
            } else {
                $char = mysqli_query($connect, "SELECT * FROM `cartoon` WHERE `Id мультфильма` =" . $id_pers['id мультфильма']);
                $chars = mysqli_fetch_assoc($char);
                $i++;
                ?>
                <div class="mult_char_global">
                    <div class="mult_char_img">
                        <a href="mult.php?id=<?php echo $chars['Id мультфильма'] ?>">
                            <img src="../img/mult/<?php echo $chars['Изображение'] ?>" alt="">
                        </a>
                    </div>
                    <div class="mult_char_name">
                        <?php echo $chars['Название'] ?>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>

</div>
</body>
</html>