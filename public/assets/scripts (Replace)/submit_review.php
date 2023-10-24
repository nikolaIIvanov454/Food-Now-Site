<?php
require_once("DatabaseConnection.php");

if(isset($_POST['review-description']) && isset($_POST['id_restaurant']) && isset($_POST['rating'])){
    $id_restaurant = intval($_POST['id_restaurant']);
    $reviewer_name = htmlspecialchars($_SESSION['logged_user'], ENT_QUOTES, 'UTF-8');
    $reviewer_id = intval($_SESSION['logged_user_id']);
    $review_text = htmlspecialchars($_POST['review-description'], ENT_QUOTES, 'UTF-8');
    $stars = intval($_POST['rating']);

    $conn = getConnection();
    $query = "SELECT COUNT(*) FROM reviews WHERE id_user = :id_user AND id_restaurant = :id_restaurant";
    $PDOStatement = $conn->prepare($query);
    $PDOStatement->bindParam(':id_user', $reviewer_id);
    $PDOStatement->bindParam(':id_restaurant', $id_restaurant);
    $PDOStatement->execute();
    $already_reviewed = $PDOStatement->fetchColumn();

    if($stars <= 5 && $already_reviewed == null){
        $conn = getConnection();
        $query = "INSERT INTO reviews (username, stars, review_description, id_user, id_restaurant) VALUES (:username, :stars, :review, :id_user, :id_restaurant); ";
        $PDOStatement = $conn->prepare($query);
        $PDOStatement->bindParam(':username', $reviewer_name);
        $PDOStatement->bindParam(':stars', $stars);
        $PDOStatement->bindParam(':review', $review_text);
        $PDOStatement->bindParam(':id_user', $reviewer_id);
        $PDOStatement->bindParam(':id_restaurant', $id_restaurant);
        $PDOStatement->execute();

        $response = ["message" => "Ревюто е написано успешно!", "authorized_user" => $reviewer_name];
    }else{
        $response = "Вече е написано ревю!";
    }

}

echo json_encode($response);

?>