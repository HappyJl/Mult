<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Char</title>
    <link rel="stylesheet" href="admin_style/mult_style.css">
    <link rel="stylesheet" href="admin_style/media.css">
</head>
<header class="nav">
    <div class="tool"><a href="char_control/char_add.php">Добавить</a></div>
    <div class="tool"><a href="main.php">Назад</a></div>
</header>
<body>
<table>
    <tr>
        <th>id</th>
        <th>Имя</th>
        <th>Описание</th>
        <th>Изображение</th>
        <th>Страница персонажа</th>
        <th>Актер озвучки</th>
    </tr>
    <?php
    include '../php/db.php';
    $char = mysqli_query($connect,"SELECT * FROM `charecters`");
    while ($char_res = mysqli_fetch_assoc($char)){
        $part = mysqli_query($connect,"SELECT * FROM `participates` WHERE  `id персонажа` =".$char_res['id персонажа']);
        $part_res = mysqli_fetch_assoc($part);
        
        $voice = mysqli_query($connect,"SELECT * FROM `voice` WHERE `id персонажа` =".$char_res['id персонажа']);
        $voice_res = mysqli_fetch_assoc($voice);
        $actor = mysqli_query($connect, "SELECT * FROM `voice-actors` WHERE `id актера` =".$voice_res['id актера']);
        ?>
        <tr>
            <td><?php echo $char_res['id персонажа']?></td>
            <td><?php echo $char_res['Имя']?></td>
            <td><?php echo $char_res['Описание']?></td>
            <td><img class="img_table" src="../img/Person/<?php echo $char_res['Изображение']?>" alt=""></td>
            <td>
                <div class="susu">
                <a href="../php/pers.php?id=<?php echo $char_res['id персонажа']?>">На страницу персонажа</a>
                </div>
            </td>
            <td>
                <?php while ($actor_res = mysqli_fetch_assoc($actor)){
                    echo $actor_res['Фамилия']." ";
                    echo $actor_res['Имя']." ";
                    echo $actor_res['Отчество']." ";
                }
                ?>
            </td>
            <td><a class="edit"  href="char_control/char_edit.php?id=<?php echo $char_res['id персонажа']?>">Изменить</a></td>
            <td><a class="del"  href="char_control/char_delete.php?id=<?php echo $char_res['id персонажа']?>">Удалить</a></td>
        </tr>
        <?php
    }
    ?>
</table>
</body>
</html>
