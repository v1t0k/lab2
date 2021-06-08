<?php
    session_start();
    require_once 'connect.php';

//    $login = $_POST['login'];
    $email= $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $avatar=$_FILES['avatar']['name'];


    if (!empty($_POST['password']))
    {
        if($password != $password_confirm)
        {
            $_SESSION['message']= 'Пароли не совпадают!';
            header('Location:../setings.php');
        }
        $stmt = $connection->prepare('update users
        set password = ?
        where  login = ?');
        $stmt->execute([md5($password),$_SESSION['user']['login']]);
    }



    if (!empty($_POST['email']))
    {
        $stmt = $connection->prepare('update users
        set email= ?
        where  login = ?');
        $stmt->execute([$email,$_SESSION['user']['login']]);
        $_SESSION['user']['email']=$email;
    }

    if (!empty($avatar))
    {
        $photo_way='uploads/'. time() .$_FILES['avatar']['name'];
        if(!move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $photo_way))
        {
            $_SESSION['message'] = 'Ошибка при загрузке изображения';
            header('Location: ../setings.php');
        }
        $stmt = $connection->prepare('update users
            set avatar= ?
            where  login = ?');
        $stmt->execute([$photo_way,$_SESSION['user']['login']]);
    }

    header('Location: ../profile.php');

?>


