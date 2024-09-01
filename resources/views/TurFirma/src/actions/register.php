<?php

session_start();
//Выносим данные из POST в отдельные переменные
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$main_email = $_POST["main_email"];
$main_telephon = $_POST["main_telephon"];
$main_password = $_POST["main_password"];

//Валидация
$_SESSION["validation"] = [];

if (empty($firstname)) {
    $_SESSION["validation"]["firstname"] = "Имя не указано";
}
if (empty($lastname)) {
    $_SESSION["validation"]["lastname"] = "Фамилия не указана";
}
if (empty($main_email)) {
    $_SESSION["validation"]["main_email"] = "Почта не указана";
}
if (empty($main_telephon)) {
    $_SESSION["validation"]["main_telephon"] = "Телефон не указан";
}

if (!empty($_SESSION["validation"])) {
    header('Location: /html/registration.php');
    die();
}
?>