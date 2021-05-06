<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Char add</title>
    <link rel="stylesheet" href="../admin_style/char.css">
</head>
<header class="nav">
    <div class="tool"><a href="../char.php">Назад</a></div>
</header>
<body>
<form method="post" action="edit.php" enctype="multipart/form-data">
    <table>
        <tr>
            <th>Имя*</th>
            <th>Описание</th>
            <th>Изображение</th>
        </tr>
        <?php
        include '../../php/db.php';
        $char_id = $_GET['id'];
        $char = mysqli_query($connect, "SELECT * FROM `charecters` WHERE `id персонажа`=".$char_id);
        $char_res = mysqli_fetch_assoc($char);
        $cartoon = mysqli_query($connect, "SELECT * FROM `cartoon`");
        $actor = mysqli_query($connect, "SELECT * FROM `voice-actors`");
        ?>
        <tr>
            <td><input type="text" id="name" name="name" value="<?php echo $char_res['Имя']?>"></td>
            <td><textarea name="opis" cols="50" rows="15" id="opis"><?php echo $char_res['Описание']?></textarea></td>
            <td><input type="file" id="img" name="img"></td>
    </table>
    <input type="hidden" id="id" name="id" value="<?= $char_res['id персонажа'] ?>">
    <div class="genre_block">
        <div class="text">
            Выберите нового актера озвучки:
        </div>
        <?php
        while ($actor_res = mysqli_fetch_assoc($actor)) {
            ?>
            <div class="genre">
                <input type="radio" value="<?php echo $actor_res['id актера'] ?>"
                       name="chember1"><?php echo $actor_res['Фамилия'] . " ";
                echo $actor_res['Имя'] . " ";
                echo $actor_res['Отчество'] ?>
            </div>
            <?php
        }
        ?>
        <div class="pers_add">
            <a href="../actor_control/actor_add.php">
                Нет нужного актера озвучивания? Добавить!
            </a>
        </div>
    </div>
    <div class="genre_block">
        <div class="text">
            Выберите новый мультфильмы:
        </div>
        <?php
        while ($cartoon_res = mysqli_fetch_assoc($cartoon)) {
            ?>
            <div class="genre">
                <input type="checkbox" value="<?php echo $cartoon_res['Id мультфильма'] ?>"
                       name="chember2[]"><?php echo $cartoon_res['Название'] . " ";
                ?>
            </div>
            <?php
        }
        ?>
        <div class="pers_add">
            <a href="../mult_control/mult_add.php">
                Нет нужного мультфильма? Добавить!
            </a>
        </div>
    </div>
    <div class="error">

    </div>
    <button type="submit" id="tok">Добавить</button>
</form>

</body>
</html>
