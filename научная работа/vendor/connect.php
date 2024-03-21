<?php
global $connect;
$connect = mysqli_connect('localhost', 'root', '', 'scientific_work');
if(!$connect){
    die("error connect db");
}
