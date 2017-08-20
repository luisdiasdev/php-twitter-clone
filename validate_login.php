<?php

    session_start();

    require_once 'db.class.php';

    $username = isset($_POST["username"]) ? $_POST["username"] : "";
    $password = isset($_POST["password"]) ? hash('sha256', $_POST["password"]) : "";

    $db = new Database();
    $conn = $db->connect();

    $query = "SELECT id, username, email FROM users WHERE username='$username' AND password='$password'";

    $result_id = mysqli_query($conn, $query);

    if($result_id) {
        $data = mysqli_fetch_array($result_id);

        if(isset($data["username"])) {

            $_SESSION['username'] = $data["username"];
            $_SESSION['email'] = $data["email"];
            $_SESSION['id'] = $data['id'];
            
            header('Location: home.php');
        } 
        else {
            header('Location: index.php?erro=1');
        }

    } else {
        echo 'Erro durante a verificação dos dados.';
    }

?>