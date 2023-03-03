<meta charset="utf-8">
<?php
require_once 'connect.php';

//Выборка массива постов для главной страницы сайта
function get_posts()
{
    global $link;
    $sql = "SELECT * FROM posts";
    $result = mysqli_query($link, $sql);
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $posts;
}
//Получение id последнего поста в БД для редиректа на страницу нового поста
function into_newpost()
{
    global $link;
    $sql = "SELECT * FROM posts ORDER BY id DESC LIMIT 1;";
    $result = mysqli_query($link, $sql);
    $newpost = mysqli_fetch_assoc($result);
    $id_newpost = $newpost['id'];
    return $id_newpost;
}
//Выборка поста по id для перехода с главной страницы сайта на страницу выбранного поста
function get_post_by_id($post_id)
{
    global $link;
    $sql = "SELECT * FROM posts WHERE id = " . $post_id;
    $result = mysqli_query($link, $sql);
    $post = mysqli_fetch_array($result);
    return ($post);
}
//Выборка пользователей для проверки зарегистрированного логина
function repeat_login()
{
    global $link;
    $check_user = "SELECT * FROM `users` ";
    $sth = mysqli_query($link, $check_user);
    $result = mysqli_fetch_all($sth, MYSQLI_ASSOC);
    foreach ($result as $oneresult) {
        $login []=$oneresult ['login'];
    }
    return ($login);
}

//функция преобразования времени time() из БД для постов
$IntlDateformatter = datefmt_create(
    'ru_RU',
    IntlDateformatter::FULL,
    IntlDateformatter::FULL,
    'Europe/Moscow',
    IntlDateformatter::GREGORIAN,
    'd MMMM yyyy, EEEE H:mm'
);

//echo '<pre>';
//var_dump ($login);
//repeat_login();
//echo '</pre>';