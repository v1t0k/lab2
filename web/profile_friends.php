<?php
    session_start();
    require_once ('backend/connect.php');

    if(!$_SESSION['user'])
    {
        header('Location: index.php');
    }


    $way = $_GET['way'];


    if(!empty($way))
    {
        $_SESSION['photo']['way'] = $way;
    }


    $query = 'select login
                from users 
                where avatar = ?';
    $stmt = $connection->prepare($query);
    $stmt->execute([$_SESSION['photo']['way']]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $login = $result['login'];


    if($_SESSION['user']['login']===$login)
    {
        header('Location: profile.php');
    }

    $photos_array=array();
    $query = 'select photo_way
        from photos
        where login = ?';
    $stmt = $connection->prepare($query);
    $stmt->execute([$login]);
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if($count > 0){
        foreach ($result as $row){
            array_push($photos_array,$row['photo_way']);
        }
    }

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main_profiles.css">
    <title>Друзья</title>
</head>


<body>

    <a href="profile.php">моя страница</a>


    <div class="avatar" style="">
        <img src="<?=$_SESSION['photo']['way']?>" class="photografi" height="" width="">
        <h2><?=$login ?></h2>
    </div>


    <div class="collage" style="">
        <?php
        if(count($photos_array) > 0)
        {
            foreach ($photos_array as $pa)
            {
                echo '<a href="photos.php?way=' . $pa . '"><img class ="profile_photo" src="' . $pa . '" width="200px" /></a>';
            }
        }
        else
        {
            $_SESSION['message'] = 'Публикаций пока нет';
        }
        ?>
    </div>




</body>