<?php
    session_start();

    if(!isset($_SESSION['username'])) {
        header("Location: index.php?erro=1");
    }

    require_once 'db.class.php';

    $id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
    $user_to_unfollow = isset($_POST['user_to_unfollow']) ? $_POST['user_to_unfollow'] : 0;

    if(!$user_to_unfollow || !$id) {
        echo '<a class="list-group-item list-group-item-danger">Não foi possível recuperar as informações do formulário</a>';
        die();
    }
    $db = new Database();
    $conn = $db->connect();
    
    $query = "DELETE FROM users_followers WHERE id_user = $id AND follower_id = $user_to_unfollow";
    
    mysqli_query($conn, $query);
    
?>