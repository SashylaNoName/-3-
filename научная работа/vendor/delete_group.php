<?php
session_start();
require_once 'connect.php';
global $connect;
if(isset($_GET['id'])){
    $id = htmlspecialchars($_GET['id']);
    echo($id);
    $res = mysqli_query($connect,"DELETE FROM `groups` WHERE `name`='$id'");
}
if($res){
    echo "Данные успешно удалены.";
} 
else{
    echo("Ошибка". mysqli_error($connect));
}
 header('Location:../profile.php');

