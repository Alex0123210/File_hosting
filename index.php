<meta charset="utf-8">
<?php
session_start();
ini_set('display_errors', 'On');
error_reporting(E_ALL);
require_once 'connect.php';

// trim (убирает лишние пробелы), htmlspecialchars (заменяет треугольные скобки и другие спецсимволы), addslashes (экранирует кавычки и специальные символы)
$login = htmlspecialchars(trim(addslashes($_POST['login'])));
$password = htmlspecialchars(trim((addslashes($_POST['password']))));
$_SESSION['login'] = $login;
$check_user = "SELECT * FROM `users` WHERE `login` = '$login' ";
$sth = mysqli_query($link, $check_user);
$user = mysqli_fetch_assoc($sth);
$hash = $user['password'];
//условия авторизации:
if (password_verify($password, $hash) && $user['login'] === $login && !empty($login) && !empty($password)) {
    // логин и пароль верные, и поля не пустые - авторизуем и задаем в сессию параметры для использования на сайте
    $_SESSION ['user'] =
        [
            "id" => $user['id'],
            "full_name" => $user['full_name'],
        ];
    header('Location: site.php');
    //логин существует, пароль неверный и не пустой
} elseif (!password_verify($password, $hash) && $user['login'] === $login && !empty($password)) {
    $_SESSION['message'] = 'Не верный пароль';
    header('Location: view/v_index.php');
    //пароль или логин не заполнены
} elseif (empty($login) || empty($password)) {
    $_SESSION['message'] = 'Заполните все поля';
    header('Location: view/v_index.php');
    //логин не существует
} elseif ($user['login'] !== $login && !empty($password)) {
    $_SESSION['message'] = 'Пользователь с таким логином не существует';
    header('Location: view/v_index.php');
}


