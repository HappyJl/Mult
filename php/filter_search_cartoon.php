<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../style/nav.css">
    <link rel="stylesheet" href="../style/filter.css">
    <link rel="stylesheet" href="../style/footer_filter.css">
    <link rel="stylesheet" href="../style/media.css">
    <link href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900" rel="stylesheet">
</head>
<header>
    <div  id="logo">
    Мульт
    </div>
    <div class="category">
        <ul class="list">
            <li>
                <a href="filter_cartoon.php" class="font-main">Мультфильм</a>
                <ul>
                    <li><a href="filter_person.php" class="font-sub">Персонажи</a></li>
                    <li><a href="filter_voice.php" class="font-sub">Актеры</a></li>
                    <li><a href="filter_authors.php" class="font-sub">Авторы</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="cont-form">
     <form action="filter_search_cartoon.php">
         <div>
         <input type="text" name="search" placeholder="Поиск" id="search-form" maxlength="200">
         </div>
     </form>
    </div>
</header>

<body>

<div id="filter-box">
        <div class="filter_name">
            <span> Мультфильмы</span>
        </div>

        <div class="mult-block">
            <?php
            include 'db.php';
            $query = mysqli_query($connect,"SELECT * FROM `country`");
            $search_get = $_GET['search'];
            $result = mysqli_query($connect,"SELECT * FROM `cartoon` WHERE `Название` LIKE '%$search_get%'");
            $never = 0;
            while($cartoon = mysqli_fetch_assoc($result)){
                $never++;
            ?>
            <div class="mult">
                <div class="mult_img">
                    <a href="mult.php?id=<?php echo $cartoon['Id мультфильма'];?>"><img src="../img/mult/<?php echo $cartoon['Изображение'] ?>" alt=""></a>
                </div>
                <div>
                    <div class="mult_opis">
                        <?php echo $cartoon['Название'];?>
                    </div>
                    <div class="mult_opis2">
                        <?php echo $cartoon['Год выпуска'] ?>
                    </div>
                </div>
            </div>
                <?php
            }
            if($never == 0){
                echo "Ничего не найдено";
            }
            ?>
        </div>
    <div class = "pagination">

    </div>
</div>

<div id="filter-search">
    <div class="filter_name">
        <span>Фильтр</span>
    </div>
    <form method="post" name="form" class="fitler_checkbox">
        <?php
        $genre = mysqli_query($connect,"SELECT * FROM `genre`");
        while($genre_res = mysqli_fetch_assoc($genre)){
            ?>
            <p><input name="vendors[]" type="checkbox" value="<?php echo $genre_res['id жанра'] ?>"/> <?php echo $genre_res['Название'] ?> </p>
            <?php
        }
        ?>
        <input name="filter" type="submit" value="Подобрать"/>
    </form>
</div>


</body>
</html>