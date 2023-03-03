<meta charset="utf-8">
<?php
session_start();
ini_set('display_errors', 'On');
error_reporting(E_ALL);
require 'connect.php';
require 'get_info.php';
//задаем переменные с введенной пользователем информацией, очищаем от лишних символов
$full_name = htmlspecialchars(filter_var(trim($_POST['full_name'])));
$login = htmlspecialchars(filter_var(trim($_POST['login'])));
$email = htmlspecialchars(filter_var(trim($_POST['email'])));
$password = htmlspecialchars(filter_var(trim($_POST['password'])));
$password_confirm = htmlspecialchars(filter_var(trim($_POST['password_confirm'])));
//задаем параметры в массив сессии, чтобы при неудачной попытке заполнения формы сохранить введене значения
$_SESSION['full_name'] = $full_name;
$_SESSION['login'] = $login;
$_SESSION['email'] = $email;
//задаем переменной функцию проверки повторяемости логина
$repeat_login=repeat_login();
//задаем условия заполнения формы
//если пароли верные, поля не пустые и логин не повторяется с существующими
// - переходим на страницу авторизации
if ($password === $password_confirm && !empty($full_name)
    && !empty($login) && !empty($email) && !empty($password_confirm) && !empty($password)
    && !in_array($login,$repeat_login)) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $check_user = mysqli_query($link, "INSERT INTO `users` (`id`, `full_name`, `login`, `email`, `password`) 
        VALUES (NULL, '$full_name', '$login', '$email', '$password')");
    header('Location: view/v_index.php');
    $_SESSION['message'] = 'Регистрация завершена';
    //если какое-то поле пустое - сообщаем
} elseif (empty($password) || empty($password_confirm) || empty($full_name)
    || empty($login) || empty($email)) {
    $_SESSION['message'] = 'Заполните все поля';
    header('Location: view/v_register.php');
    //если все поля заполнены, а пароли неверные - сообщаем
} elseif ($password !== $password_confirm && !empty($full_name)
    && !empty($login) && !empty($email) && !empty($password_confirm) && !empty($password)) {
    $_SESSION['message'] = 'Пароли не совпадают';
    header('Location: view/v_register.php');
    //если пользователь с таким логином зарегистрирован
} elseif (in_array($login,$repeat_login)) {
    $_SESSION['message'] = 'Пользователь с таким логином уже зарегистрирован';
    header('Location: view/v_register.php');
}


