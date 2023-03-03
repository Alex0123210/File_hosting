<?php
session_start();
if ($_SESSION['user']) {
    header('Location: ../site.php');
}
?>
<!Doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>

<!-- Форма регистрации -->

<form action="../register.php" method="post">
    <label>ФИО</label>
    <input type="text" name="full_name" placeholder="Введите полное имя" value="<?php
    if ($_SESSION['message']) echo $_SESSION['full_name']; ?>">
    <label>Логин</label>
    <input type="text" name="login" placeholder="Введите логин" value="<?php
    if ($_SESSION['message']) echo $_SESSION['login']; ?>">
    <label>Почта</label>
    <input type="email" name="email" placeholder="Введите адрес вашей почты" value="<?php
    if ($_SESSION['message']) echo $_SESSION['email']; ?>">
    <label>Пароль</label>
    <input type="password" name="password" placeholder="Введите пароль">
    <label>Подтверждение пароля</label>
    <input type="password" name="password_confirm" placeholder="Подтвердите пароль">
    <button type="submit">Войти</button>
    <p>
        У вас уже есть аккаунт? - <a href="v_index.php">авторизируйтесь</a>!<br><br>
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