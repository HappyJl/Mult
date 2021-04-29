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
                <a href="filter_authors.php" class="font-main">Авторы</a>
                <ul>
                    <li><a href="filter_person.php" class="font-sub">Персонажи</a></li>
                    <li><a href="filter_voice.php" class="font-sub">Актеры</a></li>
                    <li><a href="filter_cartoon.php" class="font-sub">Мультфильмы</a></li>
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
            $search_get = $_GET['search'];
            $list = explode(" ", $search_get);
            $authors_array = array();
            $never = 0;
            foreach ($list as $item) {
                $result = mysqli_query($connect, "SELECT * FROM `authors` WHERE `Фамилия` LIKE '%$item%' OR `Имя` LIKE '%$item%'");
                while ($authors = mysqli_fetch_assoc($result)) {
                    $authors_array[] = $authors;
                    if($authors = " "){
                        $never++;
                    }
                }
            }
            $authors_array = array_unique($authors_array,SORT_REGULAR);
            if ($never == 0){
                echo "Ничего не найдено";
            };
            foreach($authors_array as $authors){
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
    <div class="page">

    </div>
</div>

<div id="filter-search">
    <div class="filter_name">
        <span>Фильтр</span>
    </div>
    <form method="post" name="form" class="fitler_checkbox">
        <?php
        $career = mysqli_query($connect,"SELECT * FROM `career`");
        while($career_res = mysqli_fetch_assoc($career)){
            ?>
            <p><input name="vendors[]" type="checkbox" value="<?php echo $career_res['id карьеры'] ?>"/> <?php echo $career_res['Название'] ?> </p>
            <?php
        }
        ?>
        <input name="filter" type="submit" value="Подобрать"/>
    </form>
</div>


</body>
</html>