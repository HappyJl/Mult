<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Career add</title>
    <link rel="stylesheet" href="../admin_style/genre.css">
</head>
<header class="nav">
    <div class="tool"><a href="author_add.php">Назад</a></div>
</header>
<body>
<form method="post" action="career_add.php" enctype="multipart/form-data">
    <table>
        <tr>
            <th>Название*</th>
        </tr>
        <tr>
            <td><input type="text" id="name" name="name"></td>
        </tr>
    </table>
    <div class="error">

    </div>
    <button type="submit" id="tok">Добавить</button>
</form>

</body>
</html>
