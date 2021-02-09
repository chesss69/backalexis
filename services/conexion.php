<?php
    function conectar(){
        $servername = "localhost:3306";
        $username = "root";
        $password = "añasa@4321...";
        $dbname = "cobrapp";
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . mysqli_connect_error());
            return null;
        }
        return $conn;
    }
?>