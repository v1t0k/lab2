<?php
    session_start();
//    require_once 'connect.php';

    if(!$_SESSION['user'])
    {
        header('Location: /');
    }
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <title>настройки</title>
</head>
<body>


                        <!--Форма настройки-->


    <form action="backend/save_changes.php" method="post" enctype="multipart/form-data">
        <h2>Настройки</h2>
        <label>Сменить аватар</label>
        <input type="file" name="avatar">
        <label>Сменить email</label>
        <input type="email" name="email" placeholder="Введите новый email">
        <label>Сменить пароль</label>
        <input type="password" name="password" placeholder="Введите новый пароль">
        <input type="password" name="password_confirm" placeholder="Подтвердите пароль">
        <button type="submit">Сохранить изменения</button>

        <?php
        if($_SESSION['message']){
            echo '<p1 class="msg">' . $_SESSION['message'] . '</p1>';
        }
        unset($_SESSION['message']);
        ?>

        <a href="profile.php">назад</a>

    </form>


</body>
</html>
