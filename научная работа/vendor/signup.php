<?php
global $connect;
session_start();
require_once 'connect.php';


$surmane = htmlspecialchars($_POST['surname']);
$name = htmlspecialchars($_POST['name']);
$name_dad = htmlspecialchars($_POST['namedad']);
$password =md5($_POST['password']);
$password_confirm = md5($_POST['password_confirm']);
if(!($password===$password_confirm)){
    $_SESSION['message']="Пароли не совпадают";
    header('Location:../register.php');
    die();
}

if(($surmane)and($name)and($name_dad)and($password)){
    if(mysqli_query($connect,"INSERT INTO `teachers`(`id`, `name`, `surname`, `name_dad`, `password`) VALUES (NULL,'$name','$surmane','$name_dad','$password')")){
        $_SESSION['message']="Регистрация прошла успешно";
        header('Location:../index.php');
    }
}




