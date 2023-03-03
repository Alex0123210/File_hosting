<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Новый пост</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>

<!-- Форма загрузки файла -->

<form action="../newpost.php" method="post" enctype="multipart/form-data">
    <label>Название поста</label>
    <input type="text" name="title" placeholder="Введите название" value="<?php
    if ($_SESSION["message"]) echo $_SESSION['title']; ?>">
    <label>Описание</label>
    <input type="text" name="text" placeholder="Добавьте описание" value="<?php
    if ($_SESSION["message"]) echo $_SESSION['text']; ?>"><br>
    <label>Файлы:</label>
    <input type="file" name="file"><br>
    <button type="submit">Создать</button>
    <?php
    if ($_SESSION["message"]) {
        echo '<p class="msg"> ' . $_SESSION["message"] . ' </p>';
    }
    unset($_SESSION['message']);
    ?>
</form>

</body>
</html>

