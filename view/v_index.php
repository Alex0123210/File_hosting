<?php
session_start();
if ($_SESSION['user']) {
    header('Location: ../site.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>

<!-- Форма авторизации -->

<form action="../index.php" method="post">
    <label>Логин</label>
    <input type="text" name="login" placeholder="Введите логин" value="<?php
    if ($_SESSION['message']) echo $_SESSION['login']; ?>">
    <label>Пароль</label>
    <input type="password" name="password" placeholder="Введите пароль">
    <button type="submit">Войти</button>
    <p>
        У вас нет аккаунта? - <a href="v_register.php">зарегистрируйтесь</a>! <br><br>
        <a href="http://localhost:8888/file-hosting/file_hosting/view/sitestart.php">На главную</a>
    </p>
    <?php
    if ($_SESSION['message']) {

        echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
    }
    unset($_SESSION['message']);
    ?>
</form>

</body>
</html>