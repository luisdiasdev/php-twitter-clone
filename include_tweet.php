<?php
    session_start();

    if(!isset($_SESSION['username'])) {
        header("Location: index.php?erro=1");
    }

    require_once 'db.class.php';

    $id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;

    $tweet_text = isset($_POST['tweet_text']) ? $_POST['tweet_text'] : '';
    $tweet_text = trim($tweet_text);
    $tweet_text = strip_tags($tweet_text);
    $tweet_text = htmlspecialchars($tweet_text);
    
    if($tweet_text != '' && $id > 0) {
        $db = new Database();
        $conn = $db->connect();
        
        $query = "INSERT INTO tweets (id_user, tweet) VALUES ('$id' , '$tweet_text')";

        mysqli_query($conn, $query);
    }
?>