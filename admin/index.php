<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="admin_style/login.css">
    <title>Admin</title>
</head>
<body>
<?php
session_start();
error_reporting(0);
?>
<form action="log.php" method="post">
    <div class="block_login">
        <div class="text">
            login
        </div>
        <div class="input">
            <input type="text" class="enter" name="log">
        </div>

        <div class="text">
            password
        </div>
        <div class="input">
            <input type="password" class="enter" name="pas">
        </div>
        <button type="submit" class="button">Войти</button>
        <div class="error">
            <?php
            echo $_SESSION['msg'];
            session_unset();
            ?>
        </div>
    </div>
</form>
</body>
</html>