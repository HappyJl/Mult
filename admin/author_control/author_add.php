<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Authors add</title>
    <link rel="stylesheet" href="../admin_style/actor.css">
</head>
<header class="nav">
    <div class="tool"><a href="../autors.php">Назад</a></div>
</header>
<body>
<form method="post" action="add.php" enctype="multipart/form-data">
    <table>
        <tr>
            <th>Фамилия*</th>
            <th>Имя*</th>
            <th>Отчество</th>
            <th>Описание</th>
            <th>Изображение*</th>
        </tr>
        <?php
        include '../../php/db.php';
        $cart = mysqli_query($connect, "SELECT * FROM `cartoon`");
        $career = mysqli_query($connect, "SELECT * FROM `career`");

        ?>
        <tr>
            <td><input type="text" id="name" name="fame"></td>
            <td><input type="text" id="kolv_ep" name="name"></td>
            <td><input type="text" id="prod_ep" name="otche"></td>
            <td><textarea name="opis" cols="50" rows="15" id="opis"></textarea></td>
            <td><input type="file" id="img" name="img"></td>
        </tr>
    </table>
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
    <button type="submit" id="tok">Добавить</button>
</form>

</body>
</html>
