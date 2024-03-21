<?php
session_start();
require_once 'connect.php';
global $connect;
//echo($_SESSION['name_group']);
$url='Location:../groups.php'.'?'.'group_name='.$_SESSION['name_group'];
$add_student=$_GET['add_student'];
if(is_numeric($add_student)){
    echo($add_student);
$_SESSION['add_student']=$add_student;}
else{
    $_SESSION['message']='неправильное число';

}
header($url);