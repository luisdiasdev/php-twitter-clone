<?php

require_once 'db.class.php';

function getFollowersCount($id) {
    $db = new Database();
    $conn = $db->connect();

    $followers_count = 0;

    $query = " SELECT * FROM users_followers WHERE follower_id = $id";
    if($result = mysqli_query($conn, $query)) {
        $followers_count = mysqli_num_rows($result);
    }
    return $followers_count;
}

function getTweetCount($id) {
    $db = new Database();
    $conn = $db->connect();

    $query = " SELECT * FROM tweets WHERE id_user = $id";

    $tweet_count = 0;

    if($result = mysqli_query($conn, $query)) {
        $tweet_count = mysqli_num_rows($result);
    }

    return $tweet_count;
}

?>