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
<div id="name">
    <h4><?php echo $cartoon['Название']; ?></h4>
</div>
<div class="pers">
    <img src="../img/mult/<?php echo $cartoon['Изображение'] ?>" alt="" id="img">
</div>

<div id="block_info">
    <div class="info">Информация</div>
    <div class="info_text">
        <div class="info_dec"><b>Количество эпизодов: </b>
            <?php if ($cartoon['Количество эпизодов'] == 0) {
                echo 'Неизвестно';
            } else {
                echo $cartoon['Количество эпизодов'];
            }
            ?>
        </div>
        <div class="info_dec"><b>Продолжительность: </b>
            <?php if ($cartoon['Прод. эпиз.'] == 0) {
                echo 'Неизвестно';
            } else {
                echo $cartoon['Прод. эпиз.'];
            }
            ?>
            мин.
        </div>
        <div class="info_dec"><b>Год выпуска: </b>
            <?php if ($cartoon['Год выпуска'] == 0) {
                echo 'Неизвестно';
            } else {
                echo $cartoon['Год выпуска'];
            }
            ?>
        </div>
        <div class="info_dec"><b>Страна производитель: </b><?php echo $country['Страна'] ?></div>
        <div class="info_dec"><b>Возрастной рейтинг: </b>
            <?php
                echo $cartoon['Возрастной рейтинг'];
            ?>+
        </div>
        <div class="info_dec"><b>Рейтинг мультфильма: </b>
            <?php if ($cartoon['Рейтинг мультфильма'] == 0) {
                echo 'Неизвестно';
            } else {
                echo $cartoon['Рейтинг мультфильма'];
            }
            ?>
        </div>
        <div class="info_dec"><b>Жанры:</b>
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
            ?></div>
        <div class="info_dec"><b>Студия: </b><?php echo $studio['Название'] ?></div>
    </div>
</div>
<div id="block_opis">
    <div class="opis">Описание</div>
    <span class="text">
        <?php if ($cartoon['Описание'] == 0) {
            echo 'Описание отсутствует';
        } else {
            echo $cartoon['Описание'];
        }
        ?>
    </span>
</div>


<div id="footer">
    <div class="footer_name">
        <span><a href="all_person.php?id=<?php echo $cartoon['Id мультфильма'] ?>">Персонажи</a></span>
    </div>
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
            <div class="mult">
                <div class="mult_img">
                    <a href="pers.php?id=<?php echo $chars['id персонажа'] ?>">
                        <img src="../img/Person/<?php echo $chars['Изображение'] ?>" alt="">
                    </a>
                </div>
                <div class="mult_name_person">
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

<div id="footer2">
    <div class="footer_name2">
        <span><a href="all_authors.php?id=<?php echo $cartoon['Id мультфильма'] ?>">Авторы</a></span>
    </div>
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
            <div class="mult">
                <div class="mult_img">
                    <a href="authors.php?id=<?php echo $auths['id автора']; ?>">
                        <img src="../img/Authors/<?php echo $auths['Изображение'] ?>" alt="">
                    </a>
                </div>
                <div class="mult_name_authors">
                    <?php echo $auths['Фамилия'] ?>
                    <?php echo $auths['Имя'] ?>
                </div>
            </div>
            <?php
            if ($i > 1) {
                break;
            }
        }
    }
    ?>
</div>
</body>
</html>