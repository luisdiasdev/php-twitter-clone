<?php
    session_start();

    if(!isset($_SESSION['username'])) {
        header("Location: index.php?erro=1");
    }

    require_once 'db.class.php';

    $id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;

    $db = new Database();
    $conn = $db->connect();
    
    $query = " SELECT t.tweet, DATE_FORMAT(t.date, '%d %b %Y %T') AS date, u.username FROM tweets AS t INNER JOIN users AS u ON u.id = t.id_user ";
    $query.= " WHERE u.id = $id ";
    $query.= " OR u.id IN (SELECT follower_id FROM users_followers WHERE id_user = $id ) ";
    $query.= " ORDER BY date DESC";

    if($result = mysqli_query($conn, $query)) {
        while($data = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '<a href="#" class="list-group-item">';
            echo '<h4 class="list-group-item-heading">';
            echo $data["username"];
            echo '<small> - '. $data['date'] .'</small>';
            echo '</h4>';
            echo '<p class="list-group-item-text">'. $data['tweet'] .'</p>';
            echo '</a>';
        }
    }
?>