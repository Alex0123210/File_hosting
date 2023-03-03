<?php
session_start();

//сбрасываем сессию и переходим на страницу без авторизации
unset($_SESSION['user']);
header('Location: view/sitestart.php');
?>