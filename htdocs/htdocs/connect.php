<?php
    function connect(){
        $conn = new mysqli("localhost","root","","biblioteca");

        // Check connection
        if ($conn -> connect_error) {
            echo "Failed to connect to MySQL: " . $conn -> connect_error;
            exit();
        }

        return $conn;
    }
?>