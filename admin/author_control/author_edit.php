<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mult add</title>
    <link rel="stylesheet" href="../admin_style/actor.css">
</head>
<header class="nav">
    <div class="tool"><a href="../autors.php">Назад</a></div>
</header>
<body>
<form method="post" action="edit.php" enctype="multipart/form-data">
    <table>
        <tr>
            <th>Фамилия*</th>
            <th>Имя*</th>
            <th>Отчество</th>
            <th>Описание</th>
            <th>Изображение</th>
        </tr>
        <?php
        include '../../php/db.php';
        $author_id = $_GET['id'];
        $cart = mysqli_query($connect, "SELECT * FROM `cartoon`");
        $career = mysqli_query($connect, "SELECT * FROM `career`");
        $author = mysqli_query($connect,"SELECT * FROM `authors` WHERE `id автора`=".$author_id);
        $author_res = mysqli_fetch_assoc($author);

        ?>
        <tr>
            <td><input type="text" id="name" name="fame" value="<?php echo $author_res['Фамилия']?>"></td>
            <td><input type="text" id="kolv_ep" name="name" value="<?php echo $author_res['Имя']?>"></td>
            <td><input type="text" id="prod_ep" name="otche" value="<?php echo $author_res['Отчество']?>"></td>
            <td><textarea name="opis" cols="50" rows="15" id="opis"><?php echo $author_res['Описание']?></textarea></td>
            <td><input type="file" id="img" name="img"></td>
        </tr>
    </table>
    <input type="hidden" id="id" name="id" value="<?= $actor_res['id актера'] ?>">
    <div class="genre_block">
        <div class="text">
            Выберите мультфильм:
        </div>
        <?php
        while ($cart_res = mysqli_fetch_assoc($cart)) {
            ?>
            <div class="genre">
                <input type="checkbox" value="<?php echo $cart_res['Id мультфильма'] ?>"
                       name="chember[]"><?php echo $cart_res['Название'] ?>
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
    <div class="genre_block">
        <div class="text">
            Выберите должность:
        </div>
        <?php
        while ($career_res = mysqli_fetch_assoc($career)) {
            ?>
            <div class="genre">
                <input type="checkbox" value="<?php echo $career_res['id карьеры'] ?>"
                       name="chember1[]"><?php echo $career_res['Название'] ?>
            </div>
            <?php
        }
        ?>
        <div class="pers_add">
            <a href="../author_control/career.php">
                Нет нужной должности? Добавить!
            </a>
        </div>
    </div>
    <div class="error">

    </div>
    <input type="hidden" id="id" name="id" value="<?= $author_res['id автора'] ?>">
    <button type="submit" id="tok">Добавить</button>
</form>

</body>
</html>
