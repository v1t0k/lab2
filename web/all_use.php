<?php
    session_start();
    require_once 'backend/connect.php';

    if(!$_SESSION['user'])
    {
        header('Location: /');
    }

    $all_use=array();
    $all_use_avatar=array();
    $query = 'select login, avatar
            from users
            where login != ? ';
    $stmt = $connection->prepare($query);
    $stmt -> execute([$_SESSION['user']['login']]);
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    if(!empty($result)){
        foreach ($result as $row){
            array_push($all_use, $row['login']);
            array_push($all_use_avatar, $row['avatar']);
        }
    }


//    print_r($all_use);
//    print_r($all_use_avatar);


?>


<!doctype html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main_profiles.css">
    <title>Профиль</title>
</head>


<body>

    <a href="profile.php">Моя страница</a>


    <div class="users" style="">
            <?php
            if(count($all_use_avatar) > 0)
            {
                //foreach ($all_use_avatar as $al)
                for($i=0; $i< count($all_use_avatar); $i++)
                {
                    //echo '<a href="profile_friends.php?way=' . $al . '"><img class ="profile_photo" src="' . $al . '" width="200px" /></a>';
                    echo '<a href="profile_friends.php?way=' . $all_use_avatar[$i] . '"><img class ="profile_photo" src="' . $all_use_avatar[$i] . '" width="200px" /></a>';
                    echo '<a href="profile_friends.php?way=' . $all_use_avatar[$i] . '"> <h2> '.$all_use[$i] .' </h2></a>';
                }
            }
            else
            {
                $_SESSION['message'] = 'Дригих пользователй нет';
            }
            ?>
        </div>
</body>