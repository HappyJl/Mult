<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mult add</title>
    <link rel="stylesheet" href="../admin_style/actor.css">
    <link rel="stylesheet" href="../admin_style/media_author.css">
</head>
<header class="nav">
    <div class="tool"><a href="../actor.php">Назад</a></div>
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
        $actor_id = $_GET['id'];
        $char = mysqli_query($connect, "SELECT * FROM `charecters`");
        $actor = mysqli_query($connect, "SELECT * FROM `voice-actors` WHERE `id актера`=".$actor_id);
        $actor_res = mysqli_fetch_assoc($actor);

        ?>
        <tr>
            <td><input type="text" id="name" name="fame" value="<?php echo $actor_res['Фамилия']?>"></td>
            <td><input type="text" id="kolv_ep" name="name" value="<?php echo $actor_res['Имя']?>"></td>
            <td><input type="text" id="prod_ep" name="otche" value="<?php echo $actor_res['Отчество']?>"></td>
            <td><textarea name="opis" cols="50" rows="15" id="opis"><?php echo $actor_res['Описание']?></textarea></td>
            <td><input type="file" id="img" name="img"></td>
        </tr>
    </table>
    <input type="hidden" id="id" name="id" value="<?= $actor_res['id актера'] ?>">
    <div class="genre_block">
        <div class="text">
            Выберите нового персонажа для данного актера:
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
