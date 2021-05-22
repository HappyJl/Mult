<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mult add</title>
    <link rel="stylesheet" href="../admin_style/mult_style.css">
    <link rel="stylesheet" href="../admin_style/media_add.css">
</head>
<header class="nav">
    <div class="tool"><a href="../mult.php">Назад</a></div>
</header>
<body>
<style>
    #id {
        visibility: hidden;
    }
</style>
<form method="post" action="edit.php" enctype="multipart/form-data">
    <table>
        <tr>
            <th>Название*</th>
            <th>Кол-во серий</th>
            <th>Прод. серий</th>
            <th>Возрастной рейтинг</th>
            <th>Год выпуска</th>
            <th>Страна создатель</th>
            <th>Описание</th>
            <th>Рейтинг</th>
            <th>Изображение*</th>
            <th>Студия</th>
        </tr>
        <?php
        include '../../php/db.php';
        $genre = mysqli_query($connect, "SELECT * FROM `genre`");
        $web = mysqli_query($connect, "SELECT * FROM `website`");
        $mult_id = $_GET['id'];
        $mult = mysqli_query($connect, "SELECT * FROM `cartoon` WHERE `Id мультфильма`=" . $mult_id);
        $mult = mysqli_fetch_assoc($mult);
        $stran = mysqli_query($connect, "SELECT * FROM `country`");
        $stran = mysqli_fetch_all($stran);
        $stud = mysqli_query($connect, "SELECT * FROM `studio`");
        $stud = mysqli_fetch_all($stud);
        ?>
        <tr>
            <td><input type="text" id="name" name="name" value="<?= $mult['Название'] ?>"></td>
            <td><input type="number" id="kolv_ep" name="kolv_ep" value="<?= $mult['Количество эпизодов'] ?>"></td>
            <td><input type="number" id="prod_ep" name="prod_ep" value="<?= $mult['Прод. эпиз.'] ?>"></td>
            <td><input type="number" id="voz_rait" name="voz_rait" value="<?= $mult['Возрастной рейтинг'] ?>"></td>
            <td><input type="number" id="year" name="year" value="<?= $mult['Год выпуска'] ?>"></td>
            <td>
                <select name="stran" id="stran">
                    <?php
                    foreach ($stran as $strans) {
                        ?>
                        <option value="<?php echo $strans['0'] ?>"><?php echo $strans['1'] ?></option>
                        <?php
                    }
                    ?>
                </select>
                <div class="stran"><a href="stran.php">Нет нужной? Добавить!</a></div>
            </td>
            <td><textarea name="opis" cols="50" rows="15" id="opis"><?= $mult['Описание'] ?> </textarea></td>
            <td><input type="text" id="rait_mult" name="rait_mult" value="<?= $mult['Рейтинг мультфильма'] ?>"></td>
            <td><input type="file" id="img" name="img"></td>
            <td>
                <select name="stud" id="stud">
                    <?php
                    foreach ($stud as $studs) {
                        ?>
                        <option value="<?php echo $studs['0'] ?>"><?php echo $studs['1'] ?></option>
                        <?php
                    }
                    ?>
                </select>
                <div class="stran"><a href="studio.php">Нет нужной? Добавить!</a></div>
            </td>
        </tr>
    </table>
    <input type="hidden" id="id" name="id" value="<?= $mult['Id мультфильма'] ?>">
    <div class="genre_block">
        <div class="text">
            Выберите новые жанры(Если менять не нужно, то оставьте пустым):
        </div>
        <?php
        while ($genre_res = mysqli_fetch_assoc($genre)) {
            ?>
            <div class="genre">
                <input type="checkbox" value="<?php echo $genre_res['id жанра'] ?>"
                       name="chember[]"><?php echo $genre_res['Название'] ?>
            </div>
            <?php
        }
        ?>
        <div class="pers_add">
            <a href="../mult_control/genre.php">
                Нет нужного жанра? Добавить!
            </a>
        </div>
    </div>
    <div class="genre_block">
        <div class="text">
            Выберите новые источники просмотра:
        </div>
        <?php
        while ($web_res = mysqli_fetch_assoc($web)) {
            ?>
            <div class="genre">
                <input type="checkbox" value="<?php echo $web_res['id сайта'] ?>"
                       name="chember1[]"><?php echo $web_res['Название'] ?>
            </div>
            <?php
        }
        ?>
        <div class="pers_add">
            <a href="../mult_control/web.php">
                Нет нужного сайта? Добавить!
            </a>
        </div>
    </div>
    <div class="error">

    </div>
    <button type="submit" id="tok">Изменить</button>
</form>

</body>
</html>
