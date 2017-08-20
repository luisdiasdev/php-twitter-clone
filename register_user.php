<?php

require_once 'db.class.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $db = new Database();
    $conn = $db->connect();

    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $username = trim($username);
    $username = strip_tags($username);
    $username = htmlspecialchars($username);

    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $password = trim($password);
    $password = strip_tags($password);
    $password = htmlspecialchars($password);

    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $email = trim($email);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    /* Validate Username */
    $err_username = 0;

    if(empty($username)) {
        $err_username = 1;
    } 
    else if(strlen($username) < 4) {
        $err_username = 2;
    }
    else if(!preg_match('/^[a-z0-9]/i', $username)) {
        $err_username = 3;
    }
    /* Check if username exists in database */
    $sql = "SELECT id FROM users WHERE username = '$username'";
    if($result = mysqli_query($conn, $sql)) {
        /* Retrieve results */
        $data = mysqli_fetch_array($result, MYSQLI_ASSOC);

        /* If the ID is valid, we already have an user with this ID */
        if(isset($data['id']) || !empty($data['id'])) {
            $err_username = 4;
        }
        mysqli_free_result($result);
    }
    
    /* Validate E-mail */
    $err_email = 0;

    if(empty($email)) {
        $err_email = 1;
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err_email = 2;
    }
    /* Check if email exists in database */
    $sql = "SELECT id FROM users WHERE email = '$email'";
    if($result = mysqli_query($conn, $sql)) {
        /* Retrieve results */
        $data = mysqli_fetch_array($result, MYSQLI_ASSOC);

        /* If the ID is valid, we already have an user with this ID */
        if(isset($data['id']) || !empty($data['id'])) {
            $err_email = 3;
        }
        mysqli_free_result($result);
    }
    
    /* Validate Password */
    $err_password = 0;

    if(empty($password)) {
        $err_password = 1;
    }
    else if(strlen($password) < 4) {
        $err_password = 2;
    }
    /* If we have an error */
    if($err_username > 0 || $err_email > 0 || $err_password > 0) {
        $parameters = '';

        if($err_username > 0) {
            $parameters .= "err_username=$err_username&";
        }
        if($err_email > 0) {
            $parameters .= "err_email=$err_email&";
        }
        if($err_password > 0) {
            $parameters .= "err_password=$err_password&";
        }
        header('Location: signup.php?'.$parameters);
        exit;
    }
    /* If we have no errors */
    $password_secure = hash('sha256', $password);
    $sql = "INSERT INTO users(username, password, email) VALUES ('$username', '$password_secure', '$email')";
    if(!mysqli_query($conn, $sql)) {
        header('Location: signup.php?error=1');
        exit;
    }
    header('Location: index.php?register=1');
    exit;    
}

?>