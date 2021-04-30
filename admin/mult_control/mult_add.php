<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mult add</title>
    <link rel="stylesheet" href="../admin_style/mult_style.css">
</head>
<header class="nav">
    <div class="tool"><a href="../mult.php">Назад</a></div>
</header>
<body>
<form method="post" action="add.php" enctype="multipart/form-data">
    <table>
        <tr>
            <th>Название*</th>
            <th>Кол-во эпизодов</th>
            <th>Время эпизода</th>
            <th>Возрастной рейтинг</th>
            <th>Год выпуска</th>
            <th>Страна производитель</th>
            <th>Описание</th>
            <th>Рейтинг мультфильма</th>
            <th>Изображение*</th>
            <th>Студия</th>
        </tr>
        <?php
        include '../../php/db.php';
        $stran = mysqli_query($connect, "SELECT * FROM `country`");
        $stran = mysqli_fetch_all($stran);

        $stud = mysqli_query($connect, "SELECT * FROM `studio`");
        $stud = mysqli_fetch_all($stud);
        ?>
        <tr>
            <td><input type="text" id="name" name="name"></td>
            <td><input type="number" id="kolv_ep" name="kolv_ep"></td>
            <td><input type="number" id="prod_ep" name="prod_ep"></td>
            <td><input type="number" id="voz_rait" name="voz_rait"></td>
            <td><input type="number" id="year" name="year"></td>
            <td>
                <select name="stran" id="stran">
                    <?php
                    foreach ($stran as $strans) {
                        ?>
                        <option value="<?php echo $strans['0'] ?>"><?php echo $strans['1'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
            <td><textarea name="opis" cols="50" rows="15" id="opis"></textarea></td>
            <td><input type="number" id="rait_mult" name="rait_mult"></td>
            <td><input type="file" id="img" name="img"></td>
            <td>
                <select name="stud" id="stud">
                    <?php
                    foreach ($stud as $studs) {
                        ?>
                        <option value="<?php echo $studs['0'] ?>"><?php echo $studs['1'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
    </table>
    <button type="submit" id="tok">Добавить</button>
</form>
<?php
    if (!empty($_GET['name']) && !empty($_GET('img'))){
        echo "Успешно добавлено";
    }else{
    }
?>
</body>
</html>
