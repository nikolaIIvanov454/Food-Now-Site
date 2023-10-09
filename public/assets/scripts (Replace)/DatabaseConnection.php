<?php
    function getConnection(){
        $dbName = "restaurant";
        $servername = "localhost";
        $username = "root";
        $password = "1234";
        
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $conn;
    }
?>