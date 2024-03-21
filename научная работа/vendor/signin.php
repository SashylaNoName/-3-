<?php
session_start();
require_once 'connect.php';
global $connect;
$surmane = htmlspecialchars($_POST['surname']);
$password = md5($_POST['password']);

$check_teacher = mysqli_query($connect, "SELECT * FROM `teachers` WHERE `surname`= '$surmane' AND `password`= '$password';");
    if(mysqli_num_rows($check_teacher)>0){
    echo 'вы успешно вошли';
    $res=mysqli_query($connect, "SELECT id FROM `teachers` WHERE `surname`= '$surmane' AND `password`= '$password';");
    $id_teacher = mysqli_fetch_assoc($res);
    $_SESSION['id_teacher']=$id_teacher;
    header('Location:../profile.php');

    }else{

        $_SESSION['message']="Неверная фамилия или пароль";
        header('Location:../index.php');
    }
