<meta charset="utf-8">
<?php
require "config.php";
//Соединение с БД
$link = mysqli_connect($config ['db']['server'], $config ['db']['username'],
    $config ['db']['password'], $config ['db']['database']);
if (!$link) {
    die('Error connect to DataBase');
}
?>