<?php
    session_start();
    require_once("DatabaseConnection.php");

    $id_user = session()->get('logged_user_id');

    try {
        $connection = getConnection();
        $query = "SELECT id_restaurant FROM favourite_restaurants WHERE id_user = :id_user";
        $PDOStatement = $connection->prepare($query);
        $PDOStatement->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $PDOStatement->execute(); 
        $result = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    echo json_encode($result);
?>