<?php
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);
include 'db.php';

$array = $input['genre'];

$str = "SELECT
	`authors`.`id автора`, 
	`authors`.`Фамилия`, 
	`authors`.`Имя`, 
	`authors`.`Отчество`, 
	`authors`.`Описание`, 
	`authors`.`Изображение`
FROM
	`authors`
	INNER JOIN
	`car-aut`
	ON 
		`authors`.`id автора` = `car-aut`.`id автора`
	INNER JOIN
	career
	ON 
		`car-aut`.`id карьеры` = career.`id карьеры`
WHERE ";


if (sizeof($array) == 0){
    $sql = mysqli_query($connect, 'SELECT * FROM `authors`');
    echo json_encode($sql->fetch_all(MYSQLI_ASSOC));
    return;
}

foreach ($array as $item){
    $str = $str."`car-aut`.`id карьеры` = " . $item . " OR ";
}

$str = str_lreplace("OR", "", $str);
$str = $str . " GROUP BY authors.`id автора`";

$sql = mysqli_query($connect, $str);


echo json_encode($sql->fetch_all(MYSQLI_ASSOC));

/*
 * SELECT
	*,
	cartoon.`Id мультфильма`,
	cartoon.`Название`,
	cartoon.`Количество эпизодов`,
	cartoon.`Прод. эпиз.`,
	cartoon.`Возрастной рейтинг`,
	cartoon.`Год выпуска`,
	cartoon.`Страна производитель`,
	cartoon.`Описание`,
	cartoon.`Рейтинг мультфильма`,
	cartoon.`Изображение`,
	cartoon.`id студии`
FROM
	keeping
	INNER JOIN
	cartoon
	ON
		keeping.`id мультфильма` = cartoon.`Id мультфильма`
	INNER JOIN
	genre
	ON
		keeping.`id жанра` = genre.`id жанра`
WHERE
	keeping.`id жанра` = 1

 */

function str_lreplace($search, $replace, $subject)
{
    $pos = strrpos($subject, $search);

    if($pos !== false)
    {
        $subject = substr_replace($subject, $replace, $pos, strlen($search));
    }

    return $subject;
}