<?php
    session_start();
    if($_SESSION['user']){
        header('Location: profile.php');
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
    <title>Регистрация</title>
</head>
<body>

        <!--Форма регистрации-->

<form action="backend/signup.php" method="post" enctype="multipart/form-data">
    <h2>Регистрация</h2>
    <input type="text"name="name" placeholder="Имя" required>
    <input type="text" name="login" placeholder="Логин" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Пароль" required>
    <input type="password" name="password_confirm" placeholder="Подтверждение пароля" required>
    <button type="submit">Зарегистрироваться</button>
    <p>
        У вас уже есть аккаунт? - <a href="index.php">авторизуйтесь</a>
    </p>
    <?php
    if($_SESSION['message']){
        echo '<p1 class="msg">' . $_SESSION['message'] . '</p1>';
    }
    unset($_SESSION['message']);
    ?>

</form>
</body>
</html>