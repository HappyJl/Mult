<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Actor add</title>
    <link rel="stylesheet" href="../admin_style/actor.css">
    <link rel="stylesheet" href="../admin_style/media_author.css">
</head>
<header class="nav">
    <div class="tool"><a href="../actor.php">Назад</a></div>
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
        $char = mysqli_query($connect, "SELECT * FROM `charecters`");

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
            Выберите персонажа:
        </div>
        <?php
        while ($char_res = mysqli_fetch_assoc($char)) {
            ?>
            <div class="genre">
                <input type="radio" value="<?php echo $char_res['id персонажа'] ?>"
                       name="chember"><?php echo $char_res['Имя'] ?>
            </div>
            <?php
        }
        ?>
        <div class="pers_add">
            <a href="../char_control/char_add.php">
            Нет нужного персонажа? Добавить!
            </a>
        </div>
    </div>
    <div class="error">

    </div>
    <button type="submit" id="tok">Добавить</button>
</form>

</body>
</html>
