<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../style/nav.css">
    <link rel="stylesheet" href="../style/body_filter.css">
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
                <a href="filter_person.php" class="font-main">Персонажи</a>
                <ul>
                    <li><a href="filter_cartoon.php" class="font-sub">Мультфильмы</a></li>
                    <li><a href="filter_voice.php" class="font-sub">Актеры</a></li>
                    <li><a href="filter_authors.php" class="font-sub">Авторы</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="cont-form">
     <form action="filter_search_pers.php">
         <div>
         <input type="text" name="search" placeholder="Поиск" id="search-form" maxlength="200">
         </div>
     </form>
    </div>
</header>

<body>

<div id="filter-box">
        <div class="filter_name">
            <span>Персонажи</span>
        </div>

        <div class="mult-block">
            <?php
            include 'db.php';
            include_once "../pagination/paginatio_person.php";
            $result = mysqli_query($connect,"SELECT * FROM `charecters` ORDER BY `id персонажа` ASC LIMIT {$offset},{$forms_page}");
            include_once "../pagination/paginatio_person.php";
            while($char = mysqli_fetch_assoc($result)){
            ?>
            <div class="mult">
                <div class="mult_img">
                    <a href="pers.php?id=<?php echo $char['id персонажа'];?>"><img src="../img/Person/<?php echo $char['Изображение'] ?>" alt=""></a>
                </div>
                <div>
                    <div class="mult_opis">
                        <?php echo $char['Имя'];?>
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
            echo "<div class= pagination_style><a href='filter_person.php?page=".$i."'>".$i."</a></div>";
        }
        ?>
    </div>
</div>


</body>
</html>