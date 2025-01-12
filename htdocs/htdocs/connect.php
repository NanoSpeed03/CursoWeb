<?php
    function connect(){
        $mysqli = new mysqli("localhost:3360","root","","biblioteca");

        // Check connection
        if ($mysqli -> connect_error) {
            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
            exit();
        }

        return $mysqli;
    }
?>