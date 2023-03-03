<meta charset="utf-8">
<?php
session_start();
ini_set('display_errors', 'On');
error_reporting(E_ALL);

require_once 'connect.php';
require_once 'get_info.php';
$title = $_POST['title'];
$text = $_POST['text'];
$file = $_FILES['file'];
$author = $_SESSION['user']['full_name'];
$date = time();
echo '<pre>';
var_dump($_FILES['file']);
echo '</pre>';
// узнаем расширение текущего файла
$extension = pathinfo($file['name'], PATHINFO_EXTENSION);
// формируем уникальное имя с помощью функции time()
$fileName = 'uploads/' . time() . ".$extension";
// определяем размер файла в мегабайтах
$fileSize = $file["size"] / 1000000;
// максимальный размер файла в мегабайтах
$maxSize = 1;
// задаем допустимые типы файла
$types = ['doc', 'docx', 'xls', 'xlsx', 'png', 'jpg', 'pdf'];
$_SESSION['title'] = $title;
$_SESSION['text'] = $text;

/* задаем условие на заполненность всех полей и соответствие типа файла. 
В случае заполненности всех полей и соответствия типа файла разрешенным типам информация передается в БД*/
if (move_uploaded_file($file['tmp_name'], $fileName) && !empty($file)
    && !empty($title) && !empty($text) && in_array($extension, $types))
{
    $articles = mysqli_query($link, "INSERT INTO `posts`
    (`id`, `title`, `text`, `file`,`author`,`date`) 
    VALUES (NULL, '$title', '$text', '$fileName','$author',$date)");

    $into_newpost = into_newpost();
    header("Location: /file-hosting/file_hosting/view/v_postpage.php?post_id=$into_newpost");
    // если размер файла больше заданного - сообщаем
} elseif ($fileSize > $maxSize) {
    $_SESSION['message'] = "Слишком большой размер файла. 
    Максимальный размер не должен превышать $maxSize мБ";
    header('Location: view/v_newpost.php');
    // если не заполнено поле "Название" или "Описание" - сообщаем
} elseif (empty($title) || empty($text)) {
    $_SESSION['message'] = "Заполните все поля";
    header('Location: view/v_newpost.php');
} elseif (empty($file['name'])) {
    $_SESSION['message'] = "Файл отсутствует";
    header('Location: view/v_newpost.php');
    // если файл не добавлен или размер не соответствует - сообщаем
} elseif (!in_array($extension, $types) && !empty($file['name'])) {
    $_SESSION['message'] = "Неверный тип файла. Допустимые типы:
    zip, doc, docx, xls, xlsx, pdf, jpg, png";
    header('Location: view/v_newpost.php');
}



