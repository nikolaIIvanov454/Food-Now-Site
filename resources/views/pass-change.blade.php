<?php
    // require_once("scripts/DatabaseConnection.php");
    // session_start();

    // $servername = "localhost";
    // $username = "root";
    // $password = "1234";
    // $dbname = "restaurant";

    // $url = $_SERVER['REQUEST_URI'];
    // $url_components = parse_url($url);

    // if(isset($url_components['query'])){
    //     parse_str($url_components['query'], $params);
    //     $emailFromURL = $params['email'];

    //     $_SESSION['email'] = $emailFromURL;
    // }

    // if(isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['confirm'])){
    //     $errors = [];

    //     if($_POST['pass'] != $_POST['confirm']){
    //         $errors[] = "Паролата не е една и съща!";
    //     }
    //        REGEX IS NOT THE SAME!!!
    //     if(preg_match("/\A((?<upper>[A-Z])|(?<lower>[a-z])|(?<digit>[0-9])|.){8,}?(?(upper)(?(lower)(?(digit)|(?!))|(?!))|(?!))/", $_POST['pass']) == 0){
    //         $errors[] = "Паролата трябва да има поне 8 цифри и поне с главна и малка буква!";
    //     }

    //     if(count($errors) == 0){
    //         $encrypt = password_hash($_POST['pass'], PASSWORD_BCRYPT);

    //         $email = $_POST['email'];

    //         $con = getConnection();	
    //         $sql = "SELECT id FROM user_info WHERE email = :email;";
    //         $Statement = $con->prepare($sql);
    //         $Statement->bindParam(':email', $email);
    //         $Statement->execute(); 
    //         $result = $Statement->fetchAll(PDO::FETCH_ASSOC)[0];

    //         $user_id = $result['id'];

    //         $connection = getConnection();	
    //         $query = "UPDATE user_info SET password = :password, verify_status = true WHERE id = :user_id;";
    //         $PDOStatement = $connection->prepare($query);
    //         $PDOStatement->bindParam(':user_id', $user_id);
    //         $PDOStatement->bindParam(':password', $encrypt);
    //         $PDOStatement->execute(); 

    //         header("Location: login.php");
    //     }else{
    //         $_SESSION['invalid'] = $errors;
    //     }
    // }
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Промяна на паролата</title>
    <link rel="shortcut icon" href="{{ asset('assets/icon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/pass_reset.css') }}">
</head>
<body>
    <div class="form">
        <div class="container">
            <?php
                // if(isset($_SESSION['invalid'])){ 
                //     foreach($_SESSION['invalid'] as $value){
                //         echo "<h1>" . $value . "</h1>"; 
                //     } 
                // } 
                // unset($_SESSION['invalid']); 
            ?>
            @if(session('message'))
                <h1>{{ session('message') }}</h1>
            @endif
            <h1>Въвеждане на нова парола</h1>
            <form action="{{ route('password_change') }}" method="post">
                @csrf
                <input type="hidden" name="email" value="{{ request()->query('email') }}">
                <label for="pass">Нова парола:</label>
                <input type="password" name="pass" id="pass" required>
                <label for="confirm">Потвърждаване на нова парола:</label>
                <input type="password" name="confirm" id="confirm" required>
                <input type="submit" class="button-change" value="Променяне на паролата">
            </form>
        </div>
    </div>
</body>
</html>