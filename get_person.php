<?php
    session_start();

    if(!isset($_SESSION['username'])) {
        header("Location: index.php?erro=1");
    }

    require_once 'db.class.php';
    require_once 'get_functions.php';
    
    $name = isset($_POST['person_name']) ? $_POST['person_name'] : 0;
    $id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
    if(!$name || !$id) {
        echo '<a class="list-group-item list-group-item-danger">Não foi possível recuperar as informações do formulário</a>';
    }
    $db = new Database();

    $conn = $db->connect();
    
    // $query = "SELECT id, username, email FROM users WHERE username LIKE '%$name%' AND id <> $id";
    $query = " SELECT u.*, us.* ";
    $query.= " FROM users AS u ";
    $query.= " LEFT JOIN users_followers AS us ";
    $query.= " ON (us.id_user = $id AND u.id = us.follower_id) ";
    $query.= " WHERE u.username LIKE '%$name%' AND u.id <> $id ";

    if($result = mysqli_query($conn, $query)) {
        while($data = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            $followers = getFollowersCount($data['id']);
            $tweets = getTweetCount($data['id']);

            echo '<a class="list-group-item list-group-item-default">';
            echo '<strong>'. $data['username'] .'</strong> <br/> ';
            echo $followers.' <span class="glyphicon glyphicon-user" aria-hidden="true"></span> ';
            echo $tweets.' <span class="glyphicon glyphicon-comment" aria-hidden="true"></span><br/>';
            echo '<small>'. $data['email'] . '</small>';
            
            echo '<p class="list-group-item-text pull-right">';

            $is_following = isset($data['id_users_followers']) && !empty($data['id_users_followers']) ? true : false;
            $btn_follow_display = 'block';
            $btn_unfollow_display = 'block';
            if($is_following) {
                $btn_follow_display = 'none';
            }
            else {
                $btn_unfollow_display = 'none';
            }
            echo '<button style="display: '. $btn_unfollow_display .'" id="btn_unfollow_'. $data['id'] .'" type="button" class="btn btn-info btn_unfollow" data-user-id="'. $data['id'] . '">Deixar de Seguir</button>';
            echo '<button style="display: '. $btn_follow_display .'" id="btn_follow_'. $data['id'] .'" type="button" class="btn btn-default btn_follow" data-user-id="'. $data['id'] .'">Seguir</button>';
            echo '</p>';
            echo '<div class="clearfix"> </div>';
            echo '</a>';
        }
    } else {
        echo '<a class="list-group-item list-group-item-warning">Nenhum usuário encontrado.</a>';
    }
?>