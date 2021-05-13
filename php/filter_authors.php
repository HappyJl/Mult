<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../style/nav.css">
    <link rel="stylesheet" href="../style/filter.css">
    <link rel="stylesheet" href="../style/footer_filter.css">
    <link rel="stylesheet" href="../style/media.css">
    <script src="https://kit.fontawesome.com/94f5867c6b.js" crossorigin="anonymous"></script>
    <link href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900" rel="stylesheet">
    <script src="../js/filter_author.js"></script>
</head>
<header>
    <div  id="logo">
    Мульт
    </div>
    <div class="category">
        <ul class="list">
            <li>
                <a href="filter_authors.php" class="font-main">Авторы</a>
                <ul>
                    <li><a href="filter_cartoon.php" class="font-sub">Мультфильмы</a></li>
                    <li><a href="filter_person.php" class="font-sub">Персонажи</a></li>
                    <li><a href="filter_voice.php" class="font-sub">Актеры</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="cont-form">
     <form action="filter_search_authors.php">
         <div>
         <input type="text" name="search" placeholder="Поиск" id="search-form" maxlength="200">
         </div>
     </form>
    </div>
</header>

<body>

<div id="filter-box">
        <div class="filter_name">
            <span>Авторы</span>
        </div>

        <div class="mult-block">
            <?php
            include 'db.php';
            include_once "../pagination/paginatio_authors.php";
            $result = mysqli_query($connect,"SELECT * FROM `authors` ORDER BY `id автора` ASC LIMIT {$offset},{$forms_page}");
            while($authors = mysqli_fetch_assoc($result)){
            ?>
            <div class="mult">
                <div class="mult_img">
                    <a href="authors.php?id=<?php echo $authors['id автора'];?>"><img src="../img/Authors/<?php echo $authors['Изображение'] ?>" alt=""></a>
                </div>
                <div>
                    <div class="mult_opis">
                        <?php echo $authors['Фамилия'];?> <?php echo $authors['Имя'];?>
                    </div>
                </div>
            </div>
                <?php
            }
            ?>
        </div>
    <div class = "pagination">
        <?php
        for ($i = 1; $i <= $total_pages; $i++){
            echo "<div class= pagination_style> <a href='filter_authors.php?page=".$i."'>".$i."</a></div>";
        }
        ?>
    </div>
</div>

<div id="filter-search">
    <div class="filter_name">
        <span>Фильтр</span>
    </div>
    <div class="fitler_checkbox">
        <?php
        $career = mysqli_query($connect,"SELECT * FROM `career`");
        while($career_res = mysqli_fetch_assoc($career)){
            ?>
            <p><input name="vendors[]" type="checkbox" value="<?php echo $career_res['id карьеры'] ?>"/> <?php echo $career_res['Название'] ?> </p>
            <?php
        }
        ?>
        <input name="filter" type="submit" value="Подобрать"/>
    </div>
</div>

</body>
</html>