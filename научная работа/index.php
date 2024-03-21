<?php
session_start();
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход </title>
    <link rel="stylesheet" href="assets/css/main.css">

</head>
<body>
<div class="login-box">
    <h2>Войти</h2>
    <form action="vendor/signin.php" method="post">
        <div class="user-box">
            <input type="text" name="surname" required="">
            <label>Фамилия</label>
        </div>
        <div class="user-box">
            <input type="password" name="password" required="">
            <label>Пароль</label>
        </div>
        <a class="sv">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <button class="sv" type="submit">Войти</button>
            <?php if(isset($_SESSION['message'])){
                echo ' <a class="msg">' . $_SESSION['message'] . '</a>';
                unset($_SESSION['message']);}
            ?>
        </a>
        <p>
             <a class="sv" href="register.php"> У вас нет аккаунта? - Зарегистрируйтесь!</a>
        </p>


        <?php if(isset($_SESSION['message'])){
            echo '<br>';
            echo ' <a class="sv">' . $_SESSION['message'] . '</a>';
            unset($_SESSION['message']);}
        ?>
    </form>

</div>
</body>
</html>