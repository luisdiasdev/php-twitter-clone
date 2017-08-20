<?php 
    require_once 'get_functions.php';
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['user_id']) && !empty($_POST['user_id'])) {  
            $id = $_POST['user_id'];
            echo getFollowersCount($id);
        }
    }
?>