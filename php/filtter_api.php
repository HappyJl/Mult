<?php
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);
include 'db.php';

$array = $input['genre'];

$str = "SELECT
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
WHERE ";


if (sizeof($array) == 0){
    $sql = mysqli_query($connect, 'SELECT * FROM cartoon ORDER BY `Рейтинг мультфильма` DESC');
    echo json_encode($sql->fetch_all(MYSQLI_ASSOC));
    return;
}

foreach ($array as $item){
    $str = $str."keeping.`id жанра` = " . $item . " OR ";
}

$str = str_lreplace("OR", "", $str);
$str = $str . " GROUP BY
	cartoon.`Id мультфильма` ORDER BY `Рейтинг мультфильма` DESC";

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