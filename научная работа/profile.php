<?php
session_start();
require_once 'vendor/connect.php';
global $connect;

$id_teacher=$_SESSION['id_teacher']['id'];
$groups = mysqli_query($connect, "SELECT name, id FROM `groups` WHERE `id_teacher`= '$id_teacher' ORDER BY `name`;");
$num = mysqli_num_rows($groups);
$name_teacher1 = mysqli_query($connect, "SELECT `name`,`surname` FROM `teachers` WHERE `id`= '$id_teacher';");
$name_teacher = mysqli_fetch_assoc($name_teacher1);


?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Мои группы</title>
</head>
<body>
    <div class="table-across">
        <h1 class="h1"><?php echo $name_teacher['name']." ".$name_teacher['surname']?></h1>
        <form method="post" action="vendor/logout.php">
        <div class="exit"> <button type="submit" class="exit">Выйти</button></div>
        </form>
        <div class="table-wrapper">
    <table>
        <thead>
        <tr>
            <th>Мои группы</th>

        </tr>
        </thead>
        <tbody>
        <?php for($i = 0; $i<$num;$i++){//Вывод таблицы
            $name =mysqli_fetch_assoc($groups);
            $url = "groups.php".'?'.'group_name='.$name['id'];
            $url1="window.location.href='$url'";
            echo ("<tr > <td > ");
            echo('<div class="name_group"');
            echo("onclick= ");
            echo ($url1.">");
            echo($name['name']);
            echo('</div>');
            echo ("</form>");
            echo('</a><div class="delete" id="');
            echo($name['name']);
            echo('"><a class="delete1" ');
            echo('>X</a></div></td></tr>');
        }
        
    ?>

        </tbody>

    </table>
        </div>
        <div class="sv" ><button class="sv" type="submit"> Добавить группу </button></div>
    </div>

   


    <div class="popup" id="popup"><!-- Добавление группы -->
        <br>
        <button class="close_popup">x</button>
        <a class="as" style="font-size: 26px;">Введите название группы:</a>
        <br>
        <br>
        <form name="add_group" method="post" action="vendor/add_groups.php">
        <input type="text" name="add_name_groups" class="inputField">
        <button class = "saveButton" id="saveButton">Сохранить</button>
        </form>
    </div>
    <script>
        const svButton = document.querySelector('.sv');
        const popup = document.getElementById('popup');
        const inputField = document.getElementById('inputField');
        const saveButton = document.getElementById('saveButton');

        svButton.addEventListener('click', function() {
            popup.style.display = 'block';
        });

        saveButton.addEventListener('click', function() {
            popup.style.display = 'none';
        });
        const closeButton = document.querySelector('.close_popup');
        closeButton.addEventListener('click', function () {
            popup.style.display = 'none';
            overlay.style.display = 'none';
        });

        document.querySelector('.delete').addEventListener('click', function() {
            document.getElementById('popup1').style.display = 'block';
        });

        //удаление группы
        document.querySelectorAll('.delete').forEach(item => {
  item.addEventListener('click', function(e) {
    e.preventDefault();
    if (confirm('Удалить группу?')) {
      const id = this.getAttribute('id');
      window.location.href = `vendor/delete_group.php?id=${id}`;
    }
  });
});
    

    </script>
</body>
</html>
