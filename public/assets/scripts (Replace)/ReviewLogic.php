<?php 
require_once("../scripts/DatabaseConnection.php");
session_start();

if(isset($_POST['username'])){
    $conn = getConnection();
    $query = "SELECT username FROM user_info WHERE username = :username AND id = :user_id;";
    $PDOStatement = $conn->prepare($query);
    $PDOStatement->bindParam(':username', $_SESSION['logged_user']);
    $PDOStatement->bindParam(':user_id', $_SESSION["logged_user_id"]);
    $PDOStatement->execute();
    $username = $PDOStatement->fetchAll(PDO::FETCH_ASSOC)[0]["username"];

    header('Content-Type: application/json');
    echo json_encode($username);
}else if(isset($_POST['action']) && $_POST['action'] == "delete" && isset($_POST['id_reviews'])){
    $conn = getConnection();
    $query = "DELETE FROM reviews WHERE id_reviews = :id AND username = :username AND id_user = :user_id;";
    $PDOStatement = $conn->prepare($query);
    $PDOStatement->bindParam(':id', $_POST['id_reviews']);
    $PDOStatement->bindParam(':username', $_SESSION['logged_user']);
    $PDOStatement->bindParam(':user_id', $_SESSION["logged_user_id"]);
    $PDOStatement->execute();
}

?>