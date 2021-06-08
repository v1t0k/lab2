<?php

    session_start();
    require_once 'backend/connect.php';

    if(!$_SESSION['user'])
    {
        header('Location: /');
    }

    $way = $_GET['way'];
    //$login = $_SESSION['user']['login'];


    if(!empty($way))
    {
        $_SESSION['photo']['way']=$way;
    }



    $query = 'select photo_id, login
            from photos
            where photo_way = ?';
    $stmt = $connection->prepare($query);
    $stmt->execute([$_SESSION['photo']['way']]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $photo_id = $result['photo_id'];
    $_SESSION['photo']['photo_id']=$photo_id;
    $login = $result['login'];



    $rating_array=array();
    $query = 'select rating_point
        from ratings
        where photo_id = ?';
    $stmt = $connection->prepare($query);
    $stmt->execute([$photo_id]);
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    $count_personal_rating = $stmt->rowCount();
    if($count_personal_rating > 0){
        foreach ($result as $row){
            array_push($rating_array,$row['rating_point']);
        }
        $rating = array_sum($rating_array);
        $rating=$rating/$count_personal_rating;
    }



    $comments_array=array();
    $log_comments_array=array();
    $query = 'select comment_text, login
        from comments
        where photo_id = ?';
    $stmt = $connection->prepare($query);
    $stmt->execute([$photo_id]);
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if($count > 0){
        foreach ($result as $row){
            array_push($comments_array,$row['comment_text']);
            array_push($log_comments_array, $row['login']);
        }
    }

    ?>

<!doctype html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <title>Фотография</title>
</head>


<body>

    <h2><?=$login ?></h2>

    <div class="photos">
        <img src="<?=$_SESSION['photo']['way']?>" class="photo" height="" >
    </div>


    <div class="rating">
        <h2><?php echo round($rating,1);?></h2>
        <div class="assessment">
            <?php
                echo '<a href="backend/rating.php?number='. 1 .' &photo_id=' . $photo_id .'" style="padding-right: 3px">1</a>';
                echo '<a href="backend/rating.php?number='. 2 .' &photo_id=' . $photo_id .'">2</a>';
                echo '<a href="backend/rating.php?number='. 3 .' &photo_id=' . $photo_id .'">3</a>';
                echo '<a href="backend/rating.php?number='. 4 .' &photo_id=' . $photo_id .'">4</a>';
                echo '<a href="backend/rating.php?number='. 5 .' &photo_id=' . $photo_id .'">5</a>';
            ?>
        </div>
    </div>

    <div class="comments">
        <form action="backend/add_comment.php" method="post" enctype="multipart/form-data" class="add_comment">
            <input type="text" name="comment" placeholder="Введите комментарий" required>
            <button class="" type="submit">Добавить комментарий</button>
        </form>

        <div class="comment">
            <?php
            if(count($comments_array) > 0)
            {
                for($i=0; $i< count($comments_array); $i++)
                {
                    echo $log_comments_array[$i];
                    echo $comments_array[$i];
                }
            }
            else
            {
                $_SESSION['message'] = 'Комментариев пока нет';
            }
            ?>
        </div>
    </div>


    <?php

        if($_SESSION['message'])
        {
            echo '<p class="msg">' . $_SESSION['message'] . '</p>';
        }
        unset($_SESSION['message']);
    ?>

    <a href="">Назад</a>

</body>