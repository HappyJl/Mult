<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Actor</title>
    <link rel="stylesheet" href="admin_style/author.css">
    <link rel="stylesheet" href="admin_style/media.css">
</head>
<header class="nav">
    <div class="tool"><a href="author_control/author_add.php">Добавить</a></div>
    <div class="tool"><a href="main.php">Назад</a></div>
</header>
<body>
<table>
    <tr>
        <th>id</th>
        <th>Ф.И.О.</th>
        <th>Описание</th>
        <th>Изображение</th>
        <th>На страницу автора</th>
    </tr>
    <?php
    include '../php/db.php';
    $authors = mysqli_query($connect, "SELECT * FROM `authors`");
    while ($authors_res = mysqli_fetch_assoc($authors)) {
        $car_aut = mysqli_query($connect, "SELECT * FROM `car-aut` WHERE  `id автора` =" . $authors_res['id автора']);
        $car_aut_res = mysqli_fetch_assoc($car_aut);
        ?>
        <tr>
            <td><?php echo $authors_res['id автора'] ?></td>
            <td>
                <?php
                echo $authors_res['Фамилия'] . " ";
                echo $authors_res['Имя'] . " ";
                echo $authors_res['Отчество'] . " ";
                ?>
            </td>
            <td> <?php echo $authors_res['Описание'] ?> </td>
            <td><img class="img_table" src="../img/Authors/<?php echo $authors_res['Изображение'] ?>" alt=""></td>
            <td> <div class="author_dir"><a href="../php/authors.php?id=<?php echo $authors_res['id автора']?>">Перейти на страницу автора</a></div> </td>
            <td><a class="edit"
                   href="author_control/author_edit.php?id=<?php echo $authors_res['id автора'] ?>">Изменить</a></td>
            <td><a class="del"
                   href="author_control/author_delete.php?id=<?php echo $authors_res['id автора'] ?>">Удалить</a></td>
        </tr>
        <?php
    }
    ?>
</table>
</body>
</html>
