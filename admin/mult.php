<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Mult</title>
    <link rel="stylesheet" href="admin_style/mult_style.css">
    <link rel="stylesheet" href="admin_style/media.css">
</head>
<header class="nav">
    <div class="tool"><a href="mult_control/mult_add.php">Добавить</a></div>
    <div class="tool"><a href="main.php">Назад</a></div>
</header>
<body>
    <table>
        <tr>
            <th>id</th>
            <th>Название</th>
            <th>Кол-во серий</th>
            <th>Прод. серий</th>
            <th>Возрастной рейтинг</th>
            <th>Год выпуска</th>
            <th>Страна создатель</th>
            <th>Описание</th>
            <th>Рейтинг</th>
            <th>Изображение</th>
            <th>Студия</th>
        </tr>
<?php
    include '../php/db.php';
    $mult = mysqli_query($connect,"SELECT * FROM `cartoon`");
    while ($mult_res = mysqli_fetch_assoc($mult)){
        $stran = mysqli_query($connect,"SELECT * FROM `country` WHERE  `id страны` =".$mult_res['Страна производитель']);
        $stran_res = mysqli_fetch_assoc($stran);
        $studio = mysqli_query($connect, "SELECT * FROM `studio` WHERE `id студии`=" .$mult_res['id студии']);
        $studio_res = mysqli_fetch_assoc($studio);
        ?>
            <tr>
                <td><?php echo $mult_res['Id мультфильма']?></td>
                <td><?php echo $mult_res['Название']?></td>
                <td><?php echo $mult_res['Количество эпизодов']?></td>
                <td><?php echo $mult_res['Прод. эпиз.']?></td>
                <td><?php echo $mult_res['Возрастной рейтинг']?></td>
                <td><?php echo $mult_res['Год выпуска']?></td>
                <td><?php echo $stran_res['Страна']?></td>
                <td><?php echo $mult_res['Описание']?></td>
                <td><?php echo $mult_res['Рейтинг мультфильма']?></td>
                <td><img class="img_table" src="../img/mult/<?php echo $mult_res['Изображение']?>" alt=""></td>
                <td><?php echo $studio_res['Название']?></td>
                <td><a class="edit"  href="mult_control/mult_edit.php?id=<?php echo $mult_res['Id мультфильма']?>">Изменить</a></td>
                <td><a class="del"  href="mult_control/mult_delete.php?id=<?php echo $mult_res['Id мультфильма']?>">Удалить</a></td>
            </tr>
<?php
    }
?>
        </table>
</body>
</html>
