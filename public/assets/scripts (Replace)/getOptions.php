<?php
require_once('DatabaseConnection.php');

try {
    $connection = getConnection();
    $query = "SELECT city FROM restaurant_regions;";
    $PDOStatement = $connection->prepare($query);
    $PDOStatement->execute(); 
    $result = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

echo json_encode($result);
?>