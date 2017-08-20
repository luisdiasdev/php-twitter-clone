<?php

class Database {
    private $host = "localhost";
    private $dbuser = "root";
    private $dbpwd = "";
    private $database = "twitter_clone";

    public function connect() {
        $conn = mysqli_connect($this->host, $this->dbuser, $this->dbpwd, $this->database);

        mysqli_set_charset($conn, "utf8");

        if(mysqli_connect_errno()) {
            echo 'Erro ao tentar se conectar com o banco de dados MySQL: '. mysqli_connect_error();
        }

        return $conn;
    }

    public function query($str) {
        
    }
}

?>