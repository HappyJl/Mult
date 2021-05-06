<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Actor</title>
    <link rel="stylesheet" href="admin_style/mult_style.css">
</head>
<header class="nav">
    <div class="tool"><a href="actor_control/actor_add.php">Добавить</a></div>
    <div class="tool"><a href="main.php">Назад</a></div>
</header>
<body>
<table>
    <tr>
        <th>id</th>
        <th>Ф.И.О.</th>
        <th>Описание</th>
        <th>Персонажи</th>
        <th>Изображение</th>
    </tr>
    <?php
    include '../php/db.php';
    $actor = mysqli_query($connect, "SELECT * FROM `voice-actors`");
    while ($actor_res = mysqli_fetch_assoc($actor)) {
        $voice = mysqli_query($connect, "SELECT * FROM `voice` WHERE  `id актера` =" . $actor_res['id актера']);
        $voice_res = mysqli_fetch_assoc($voice);
        if ($voice_res == null) {
        } else {
            $char = mysqli_query($connect, "SELECT * FROM `charecters` WHERE `id персонажа`=" . $voice_res['id персонажа']);
        }
        ?>
        <tr>
            <td><?php echo $actor_res['id актера'] ?></td>
            <td>
                <?php
                echo $actor_res['Фамилия'] . " ";
                echo $actor_res['Имя'] . " ";
                echo $actor_res['Отчество'] . " ";
                ?>
            </td>
            <td> <?php echo $actor_res['Описание'] ?> </td>
            <td>
                <?php
                    while ($char_res = mysqli_fetch_assoc($char)) {
                        echo $char_res['Имя'];
                    }
                ?>
            </td>
            <td><img class="img_table" src="../img/Actors/<?php echo $actor_res['Изображение'] ?>" alt=""></td>
            <td><a class="edit"
                   href="actor_control/actor_edit.php?id=<?php echo $actor_res['id актера'] ?>">Изменить</a></td>
            <td><a class="del"
                   href="actor_control/actor_delete.php?id=<?php echo $actor_res['id актера'] ?>">Удалить</a></td>
        </tr>
        <?php
    }
    ?>
</table>
</body>
</html>
