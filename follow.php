<?php
    session_start();

    if(!isset($_SESSION['username'])) {
        header("Location: index.php?erro=1");
    }

    require_once 'db.class.php';

    $id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
    $user_to_follow = isset($_POST['user_to_follow']) ? $_POST['user_to_follow'] : 0;

    if(!$user_to_follow || !$id) {
        echo '<a class="list-group-item list-group-item-danger">Não foi possível recuperar as informações do formulário</a>';
        die();
    }
    $db = new Database();
    $conn = $db->connect();
    
    $query = "INSERT INTO users_followers(id_user, follower_id) VALUES ($id, $user_to_follow)";
    
    
    mysqli_query($conn, $query);
    
?>