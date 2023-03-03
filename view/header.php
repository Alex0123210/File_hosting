<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: ../sitestart.php');
    die();
}
require "../get_info.php";
require "../connect.php"; //delite
require "../config.php";

?>
<!DOCTYPE html>
<html land="ru">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<head>
    <link rel="stylesheet" type="text/css" href="css/site.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Файлообменник</title>
</head>
<body>
<div id="some_block">
    <form>
        <p style="margin: 10px 0;">Привет, <?= $_SESSION['user']['full_name'] ?></p>
        <a href="view/v_newpost.php" class="post">Создать пост</a>
        <a href="logout.php" class="post">Выход</a>
    </form>
</div>
<div id="content">
    <div id="header"><h2 style="margin: 0px 10px;"><?php echo $config ['title'] ?></h2></div>
</body>
</html>


