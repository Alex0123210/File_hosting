<meta charset="utf-8">
<?php
session_start();
require "header.php";
ini_set('display_errors', 'On');
error_reporting(E_ALL);
require "../connect.php";

//останавливаем скрипт, если в post_id не число
$post_id = $_GET['post_id'];
if (!is_numeric($post_id))
    die();
//получаем массив информации определенного поста из БД

$post = get_post_by_id($post_id);

?>
<div id="content">
    <div id="main">
        <h3><?= $post['title']; ?></a></h3>
        <div class="row">
        </div>
        <p><?= $post['text']; ?></p>
        <h6> Автор: <?= $post['author']; ?></h6>
        <p><a href="http://localhost:8888/file-hosting/file_hosting/<?= $post['file']; ?>">Скачать файл (ссылка)</a></p>
        <p><?= datefmt_format($IntlDateformatter, $post['date']); ?></p>

    </div>
</div>
<?php
require "footer.php";
?>

