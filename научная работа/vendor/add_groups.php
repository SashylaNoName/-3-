<?php
session_start();
require_once 'connect.php';
global $connect;
$add_group = htmlspecialchars($_POST['add_name_groups']);
$id_teach=$_SESSION['id_teacher']['id'];
$res =  mysqli_query($connect, "INSERT INTO `groups`( `name`, `id_teacher`) VALUES ('$add_group','$id_teach')");
if(!$res){
    mysqli_error($res);
}
header('Location:../profile.php');