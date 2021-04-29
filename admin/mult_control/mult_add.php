<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Mult</title>
    <link rel="stylesheet" href="../admin_style/mult_style.css">
</head>
<header class="nav">
    <div class="tool"><a href="../mult_control/mult_add.php">Подтвердить</a></div>
</header>
<body>
<table>
    <tr>
        <th>Id мультфильма</th>
        <th>Название</th>
        <th>Количество эпизодов</th>
        <th>Продолжительность эпизода</th>
        <th>Возрастной рейтинг</th>
        <th>Год выпуска</th>
        <th>Страна производитель</th>
        <th>Описание</th>
        <th>Рейтинг мультфильма</th>
        <th>Изображение</th>
        <th>Студия</th>
    </tr>
    <?php
    include '../../php/db.php';
        ?>
        <tr>
            <td>Автоматический</td>
            <td><input type="text"></td>
            <td><input type="number"></td>
            <td><input type="number"</td>
            <td><input type="number"</td>
            <td><input type="number"</td>
            <td>
                <select name="" id="">
                    <option value="">1</option>
                </select>
            </td>
            <td><input type="text"></td>
            <td><input type="number"></td>
            <td>???</td>
            <td>
                <select name="" id="">
                    <option value="">1</option>
                </select>
            </td>
        </tr>

</table>
</body>
</html>
