<?php
session_start();
require_once 'vendor/connect.php';
error_reporting(E_ERROR);
global $connect;
$id_teacher=$_SESSION['id_teacher']['id'];
if(isset($_GET['group_name'])){
    $group_name=$_GET['group_name'];
}
else{
    $group_name=$_SESSION['name_group'];
}

$res1= mysqli_query($connect,"SELECT `id` FROM `groups` WHERE `name`= '$group_name'");
$id_group1=mysqli_fetch_assoc($res1);
$id_group=$id_group1['id'];
$_SESSION['id_group']=$id_group;
$_SESSION['name_group']=$group_name;
$res = mysqli_query($connect, "SELECT `id`, `name`,`surmane`,`module1`,`module2`,`module3`,`exam`,`result` FROM `students` WHERE `id_group`='$id_group' ORDER BY `surmane` ");
$number = mysqli_num_rows($res);
$all_info_group1=mysqli_fetch_assoc($res);
$i=0;
if (isset($_SESSION['add_student'])){
    $number+=$_SESSION['add_student'];
}


foreach ($res as $row){
    $id_student[$i]=$row['id'];
    $name_students[$i]=$row['name'];
    $surname_students[$i]=$row['surmane'];
    $name_dad_students[$i]=$row['name_dad'];
    $module1_students[$i]=$row['module1'];
    $module2_students[$i]=$row['module2'];
    $module3_students[$i]=$row['module3'];
    $exam_students[$i]=$row['exam'];
    $i++;
}
function Echosmith($param): void
{
    if(isset($param)){
        echo($param);
    }
    else{
        echo("");
    }
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/groups.css">
    <title><?=$group_name?></title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
<div class="container">
    <form method="post" action="profile.php">
        <div class="exit"> <button type="submit" class="exit">Группы</button></div>
    </form>
    <h1> <?php echo($group_name)?>
    </h1>
    <br>
    <br>
    <table id="edit_table">
        <thead>
        <tr>
            <th contenteditable="true">Фамилия</th>
            <th contenteditable="true">Имя</th>
            <th contenteditable="true">1 модуль </th>
            <th contenteditable="true">2 модуль </th>
            <th contenteditable="true">3 модуль</th>
            <th contenteditable="true">Экзамен</th>
            <th contenteditable="true">Итоги</th>
            <th style display:none></th>
        </tr>
        </thead>
        <form action="vendor/save_data_from_table.php" method="post">
        <?php


        for ($i=0;$i<$number;$i++) {
            ?>

            <tr contenteditable = "true" class="add-row" >

               <td><span><?= Echosmith($surname_students[$i]) ?></span><label>
                <input class="name" autocomplete='off' type="text" id="inputField" name="surname_<?= $id_student[$i] ?>" value="<?= Echosmith($surname_students[$i]); ?>">
            </td>

        <td><span><?= Echosmith($name_students[$i]) ?></span><label>
                <input class="name" autocomplete='off' type="text" id="inputField" name="name_<?= $id_student[$i] ?>" value="<?= Echosmith($name_students[$i]); ?>">
            </td>

        <td><span><?= Echosmith($module1_students[$i]) ?></span><label>
                <input class="other" autocomplete='off' name="module1_<?= $id_student[$i] ?>" value="<?= Echosmith($module1_students[$i]) ?>">
            </label></td>

        <td><span><?= Echosmith($module2_students[$i]) ?></span><label>
                <input class="other" autocomplete='off' name="module2_<?= $id_student[$i] ?>" value="<?= Echosmith($module2_students[$i]) ?>">
            </label></td>

        <td><span><?= Echosmith($module3_students[$i]) ?></span> <label>
                <input class="other" autocomplete='off' name="module3_<?= $id_student[$i] ?>" value="<?= Echosmith($module3_students[$i]) ?>">
            </label>
        </td>
        <td><span><?= Echosmith($exam_students[$i]) ?></span><label>
                <input class="other" autocomplete='off' name="exam_<?= $id_student[$i] ?>" value="<?= Echosmith($exam_students[$i]) ?>">
            </label></td>
        <td><?= $module1_students[$i] + $module2_students[$i] + $module3_students[$i] + $exam_students[$i] ?></td>
        <td class="delete" id="<?= Echosmith($id_student[$i])?>"><a >x</a></td>
    </tr>

    <?php
}
unset($_SESSION['add_student']);
?>
</table>
    <button class="sve" id="save_butt" onclick="location.href='vendor/save_data_from_table.php' ">Сохранить: </button>
    </form>
    <div class="sv"><button  class="sv" type="submit"> Добавить студентов: </button></div>

    <?php if(isset($_SESSION['message'])){
        echo '<br>';
        echo ' <a class="sv">' . $_SESSION['message'] . '</a>';
        unset($_SESSION['message']);}
    ?>
    <div class="popup" id="popup">
        <button class="close_popup">x</button>
        <br>
        <a class="as" style="font-size: 26px;">Введите количество студентов:</a>

        <br>
        <br>


        <form name="add_group" method="get" action="vendor/add_student.php">
            <input type="text"  name="add_student" class="inputField">
            <button class = "saveButton"  id="saveButton">Сохранить</button>
        </form>
    </div>
</div>
    <script src="assets/js/main.js"></script>
    <script>function showInput() {
            document.getElementById("myInput").style.display = "block";
        }</script>
<script>

    $(document).ready(function() {
        $('td').on('click', function() {
            $(this).find('span').hide();
            $(this).find('input').show().focus();
        });
    });

    document.querySelectorAll('.delete').forEach(item => {//удаление группы
  item.addEventListener('click', function(e) {
    e.preventDefault();
    if (confirm('Удалить студента?')) {
      const id = this.getAttribute('id');
      window.location.href = `vendor/delete_student.php?id=${id}`;
    }
  });
});

</script>
</body>
</html>