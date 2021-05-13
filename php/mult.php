<?php
//ini_set('display_errors', 0);
//ini_set('display_startup_errors', 0);
//error_reporting(E_ALL);
include 'db.php';
$let = $_GET['id'];
$result = mysqli_query($connect, "SELECT * FROM `cartoon` WHERE `Id мультфильма`=" . $let);

$cartoon = mysqli_fetch_assoc($result);

$result1 = mysqli_query($connect, "SELECT * FROM `studio` WHERE `id студии` = " . $cartoon['id студии']);
$studio = mysqli_fetch_assoc($result1);

$res = mysqli_query($connect, "SELECT * FROM `country` WHERE `id страны` = " . $cartoon['Страна производитель']);
$country = mysqli_fetch_assoc($res);

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
    <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900"
          rel="stylesheet">
</head>
<header>
    <div id="logo">
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
<div class="mult_name"><?php echo $cartoon['Название'] ?></div>

<div class="content">
    <div class="mult_info"><img class="mult_image" src="../img/mult/<?php echo $cartoon['Изображение'] ?>" alt="">
    </div>
    <div class="mult_info_info">
        <div class="text_info">Информация</div>
        <div class="text_info_deck">Количество эпизодов:
            <?php if ($cartoon['Количество эпизодов'] == 0) {
                echo 'Неизвестно';
            } else {
                echo $cartoon['Количество эпизодов'];
            }
            ?>
        </div>
        <div class="text_info_deck">
            Продолжительность:
            <?php if ($cartoon['Прод. эпиз.'] == 0) {
                echo 'Неизвестно';
            } else {
                echo $cartoon['Прод. эпиз.'];
            }
            ?>
            мин.
        </div>
        <div class="text_info_deck">
            Год выпуска:
            <?php if ($cartoon['Год выпуска'] == 0) {
                echo 'Неизвестно';
            } else {
                echo $cartoon['Год выпуска'];
            }
            ?>
        </div>
        <div class="text_info_deck">
            Страна производитель: <?php echo $country['Страна'] ?>
        </div>
        <div class="text_info_deck">Возрастной рейтинг:
            <?php
            echo $cartoon['Возрастной рейтинг'];
            ?>+
        </div>
        <div class="text_info_deck">
            Рейтинг мультфильма:
            <?php if ($cartoon['Рейтинг мультфильма'] == 0) {
                echo 'Неизвестно';
            } else {
                echo $cartoon['Рейтинг мультфильма'];
            }
            ?>
        </div>
        <div class="text_info_deck">
            Жанры:
            <?php
            $result2 = mysqli_query($connect, "SELECT * FROM `keeping` WHERE `id мультфильма` =" . $cartoon['Id мультфильма']);
            $keeping = mysqli_fetch_all($result2);
            if ($keeping == null) {
                echo 'Неизвестно';
            } else {
                foreach ($keeping as $keepings) {
                    $result3 = mysqli_query($connect, "SELECT * FROM `genre` WHERE `id жанра` =" . $keepings['1']);
                    $genre = mysqli_fetch_all($result3);
                    foreach ($genre as $genres) {
                        echo $genres['1'] . ", ";
                    }
                }
            }
            ?>
        </div>
        <div class="text_info_deck">
            Студия:<?php echo $studio['Название'] ?>
        </div>
    </div>
    <div class="mult_info_watch">
        <div class="text_watch">Смотреть:</div>
        <?php
        $watch = mysqli_query($connect, "SELECT * FROM `watch` WHERE `id мультфильма`=" . $cartoon['Id мультфильма']);
        while ($watch_res = mysqli_fetch_assoc($watch)) {
            if ($watch_res == null) {

            } else {
                $sours = mysqli_query($connect, "SELECT * FROM `website` WHERE `id сайта`=" . $watch_res['id сайта']);
                $sours_res = mysqli_fetch_assoc($sours);
                ?>
                <a href="<?php echo $watch_res['Смотреть']?>">
                    <div class="outside">
                        <?php echo $sours_res['Название']?>
                    </div>
                </a>
                <?php
            }
        }
        ?>

    </div>
</div>

<div class="opis">
    <div class="opis_up">Описание</div>
    <div class="opis_text">
        <?php if ($cartoon['Описание'] == 0) {
            echo 'Описание отсутствует';
        } else {
            echo $cartoon['Описание'];
        }
        ?>
    </div>
</div>

<div class="footer">
    <div class="mult_char">
        <a href="all_person.php?id=<?php echo $cartoon['Id мультфильма'] ?>">
            <div class="mult_char_text">Персонажи</div>
        </a>
        <?php
        $i = 0;
        $result6 = mysqli_query($connect, "SELECT * FROM `participates` WHERE `id мультфильма` =" . $cartoon['Id мультфильма']);

        while ($id_pers = mysqli_fetch_assoc($result6)) {
            if ($id_pers == null) {
                echo 'Персонажей пока нет';
            } else {
                $char = mysqli_query($connect, "SELECT * FROM `charecters` WHERE `id персонажа` =" . $id_pers['id персонажа']);
                $chars = mysqli_fetch_assoc($char);
                $i++;
                ?>
                <div class="mult_char_global">
                    <div class="mult_char_img">
                        <a href="pers.php?id=<?php echo $chars['id персонажа'] ?>">
                            <img src="../img/Person/<?php echo $chars['Изображение'] ?>" alt="">
                        </a>
                    </div>
                    <div class="mult_char_name">
                        <?php echo $chars['Имя'] ?>
                    </div>
                </div>
                <?php
                if ($i > 2) {
                    break;
                }
            }
        }
        ?>
    </div>

    <div class="mult_char">
        <a href="all_authors.php?id=<?php echo $cartoon['Id мультфильма'] ?>">
            <div class="mult_char_text">Авторы</div>
        </a>
        <?php
        $i = 0;
        $result4 = mysqli_query($connect, "SELECT * FROM `created` WHERE `id мультфильма` =" . $cartoon['Id мультфильма']);
        while ($created = mysqli_fetch_assoc($result4)) {
            if ($created == null) {
                echo 'Персонажей пока нет';
            } else {
                $auth = mysqli_query($connect, "SELECT * FROM `authors` WHERE `id автора` =" . $created['id автора']);
                $auths = mysqli_fetch_assoc($auth);
                $i++;
                ?>
                <div class="mult_char_global">
                    <div class="mult_char_img">
                        <a href="authors.php?id=<?php echo $auths['id автора']; ?>">
                            <img src="../img/Authors/<?php echo $auths['Изображение'] ?>" alt="">
                        </a>
                    </div>
                    <div class="mult_char_name">
                        <?php echo $auths['Фамилия'] ?>
                        <?php echo $auths['Имя'] ?>
                    </div>
                </div>
                <?php
                if ($i > 2) {
                    break;
                }
            }
        }
        ?>
    </div>
</div>

</body>
</html>