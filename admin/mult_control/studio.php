<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mult add</title>
    <link rel="stylesheet" href="../admin_style/stran_add.css">
</head>
<header class="nav">
    <div class="tool"><a href="mult_add.php">Назад</a></div>
</header>
<body>
<form method="post" action="studio_add.php" enctype="multipart/form-data">
    <table class="str_add">
        <tr>
            <th>Название студии</th>
        </tr>
        <?php
        include '../../php/db.php';
        ?>
        <tr>
            <td><input type="text" id="name" name="name"></td>
        </tr>
    </table>
    <button type="submit" id="tok">Добавить</button>
</form>

</body>
</html>
