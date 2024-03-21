<?php
session_start();
require_once 'connect.php';
global $connect;
$i=0;
foreach ($_POST as $key => $value){
    $arr[$i]=$value;
    $id[$i]=substr($key, -1);
    $i++;
}
if (isset($arr)) {
    for ($i = 0; $i < count($arr); $i++) {
        $i = (int)$i;
        if (($i % 6) == 0) {
            $surname[$i] = $arr[$i];
        }
        if (($i % 6) == 1) {
            $name[$i] = $arr[$i];
        }
        if (($i % 6) == 2) {
            $module1[$i] = $arr[$i];
        }
        if (($i % 6) == 3) {
            $module2[$i] = $arr[$i];
        }
        if (($i % 6) == 4) {
            $module3[$i] = $arr[$i];
        }
        if (($i % 6) == 5) {
            $exam[$i] = $arr[$i];
        }

    }
    $name = array_values($name);
    $surname = array_values($surname);
    $module1 = array_values($module1);
    $module2 = array_values($module2);
    $module3 = array_values($module3);
    $exam = array_values($exam);


    $id_group = $_SESSION['id_group'];

    $re2 = mysqli_query($connect, "SELECT `id` FROM students where`id_group`='$id_group' ORDER BY `surmane`");
    $number_student = mysqli_num_rows($re2);
    for ($i = 0; $i < $number_student; $i++) {
        $re3 = mysqli_fetch_assoc($re2);
        $id_student[$i] = $re3['id'];
        $update = mysqli_query($connect, "UPDATE `students` SET `name`='$name[$i]',`surmane`='$surname[$i]',`module1`='$module1[$i]',`module2`='$module2[$i]',`module3`='$module3[$i]',`exam`='$exam[$i]' WHERE `id`='$id_student[$i]'");
        if ($update) {
            echo('update');
        }
    }
    if ((!$name[$number_student] == 0) or (!$surname[$number_student] == 0) or (!$module1[$number_student] == 0) or (!$module2[$number_student] == 0) or (!$module3[$number_student] == 0) or (!$exam[$number_student] == 0)) {
        // if ($name[$number_student] === 0) {
        //     $name[$number_student] = 'Введите имя';
        // }
        // if ($surname[$number_student] === 0) {
        //     $surname[$number_student] = 'Введите фамилию';
        // }
        echo($id_group);
        $insert = mysqli_query($connect, "INSERT INTO `students`( `name`, `surmane`, `id_group`, `module1`, `module2`, `module3`, `exam`) VALUES ('$name[$number_student]','$surname[$number_student]','$id_group','$module1[$number_student]','$module2[$number_student]','$module3[$number_student]','$exam[$number_student]')");
        if ($insert) {
            $_SESSION['message']='Сохранено';
        }
    }
}
$url='Location:../groups.php'.'?'.'group_name='.$_SESSION['name_group'];
echo $_SESSION['name_group'];
header($url);


