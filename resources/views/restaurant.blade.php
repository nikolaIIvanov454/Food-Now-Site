<?php
// session_start();
// require_once("../scripts/DatabaseConnection.php");

// if (!$_SESSION['user']){
//     header("location: ../login.php");
//     exit;
// }

// $name = null;

// if(isset($_POST['id'])){
//     $id = $_POST['id'];

//     $conn = getConnection();
//     $query = "SELECT * FROM restaurant_list WHERE id_restaurant = :id";
//     $PDOStatement = $conn->prepare($query);
//     $PDOStatement->bindParam(':id', $id);
//     $PDOStatement->execute();
//     $result = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);

//     $name = $result[0]['name'];

//     $sql = "SELECT * FROM foods_restaurant WHERE id_restaurant = :id;";
//     $statement = $conn->prepare($sql);
//     $statement->bindParam(':id', $id);
//     $statement->execute();
//     $output = $statement->fetchAll(PDO::FETCH_ASSOC);

//     $con = getConnection();
//     $query = "SELECT * FROM reviews WHERE id_restaurant = :id";
//     $PDOStatement = $con->prepare($query);
//     $PDOStatement->bindParam(':id', $id);
//     $PDOStatement->execute();
//     $reviews = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
// }
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/f2264ef78f.js" crossorigin="anonymous" defer></script>
    <script src="../scripts/shopping_cart.js" defer></script>
    <script src="{{ asset('js/script_menu.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js" defer></script>
    <script src="../scripts/sendReview.js" defer></script>
    <script src="../scripts/handleDeletion.js"></script>
    <link rel="shortcut icon" href="{{ asset('assets/icon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/home-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <script>
        
    </script>
    <title>FoodNow - Ресторант: <?php //if(isset($name)){ echo $name; }else{ echo "Restaurant"; } ?></title>
</head>
<body>
    <header>
        <nav class="navbar">
        <div class='navbar-container'>
            <div id="nav-icon" class='navbar-toggle'>
				<span></span>
				<span></span>
				<span></span>
			</div>
            <ul class='navbar-items'>
                <li><img src="{{ asset('assets/icon.svg') }}" alt="icon"></li>
                <li><a href="{{ url('/home') }}">Начална страница</a></li>
                @if(!session()->has('logged_username'))
                    <li><a href="{{ url('/login') }}">Влизане</a></li>
                    <li><a href="{{ url('/register') }}">Регистрация</a></li>
                @endif
                <li><a href="{{ url('/about-us') }}">За нас</a></li>
                <?php //if(isset($_SESSION['is_Admin']) && $_SESSION['is_Admin'] == "true"){
                    //echo "<li><a href='../admin.php'>Администраторски панел</a></li>";
                //} ?>
                <li id="float-r">
                    <div class="logout">
                        <i class="fas fa-shopping-cart" style="font-size: 2em; color: #fff;"><i class="fas fa-plus-circle" style="font-size: 0.5em; color: #f6673c; transform: translate(-80%, -100%);"></i></i>
                        @if(session()->has('logged_username'))
                            <i class='fa-solid fa-circle-user' style='font-size: 3em; color: #fff;'></i><h1 style='color: #fff; width: min-content; margin-left: 5px; text-transform: capitalize;'>{{ session('logged_username') }}</h1>
                            <a href="{{ route('logout') }}">Излизане</a>
                        @endif
                        <div id="cart">
                        <?php
                            // $outputCheckout = "";
                            // $total = 0;

                            // if(!empty($_SESSION['shopping_cart'])){
                            //     $outputCheckout .= "<table><thead><tr><td>Продукт:</td><td>Грамаж:</td><td>Цена:</td><td>Количество:</td><td><i class='fa-solid fa-xmark' style='color: red; font-size: 3em;'></i></td></tr></thead>";

                            //     foreach($_SESSION['shopping_cart'] as $key => $value){
                            //         $outputCheckout .= "<tr><td>" . $value['p_name'] . "</td><td>" . $value['p_weight'] . "</td><td>" . (doubleval($value['p_price']) * doubleval($value['p_quantity'])) . "</td><td>" . $value['p_quantity'] . "</td><td><button class='remove' data-remove-id='" . $value['p_id'] . "' data-remove-name='" . $value['p_name'] . "'>Изтрии</button></td></tr>";

                            //         $total = $total + (doubleval($value['p_price']) * doubleval($value['p_quantity']));
                            //     }

                            //     $outputCheckout .= "</table>";
                            //     $outputCheckout .= "<div style='text-align: center;' id='total'><b>Total: " . $total . "</b></div>";
                            //     $outputCheckout .= "<form action='../checkout.php' method='post'><input type='hidden' name='total' value=" . $total . "><button id='checkout-button'>Завършване на поръчката</button></form>";
                            // }

                            // echo $outputCheckout;
                        ?>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        </nav>
    </header> 

    @if($loaded_restaurant)
        @foreach($loaded_restaurant as $restaurant)
           <div class='container'>
            <input type='hidden' class='id' name='id' value="{{ $restaurant->id }}">
            <div class='left-div'><div class='center-text'><h1>{{ $restaurant->name }}</h1></div>
            <div class='image-div'><img src="{{ $restaurant->image_path }}"></div></div>
            <div class='right-div'><div class='center-text desc-clicked'><p>{{ $restaurant->description }}</p></div>
            <div class='center-text'><h2>{{ $restaurant->price }}</h2></div></div></div><div class='line'></div>
            <div class='products'>
                <!-- <h1>Меню:</h1>
                <h2>Какво предлага ресторанта.</h2>
                <table><tr><th>Тип Храна:</th><th>Грамаж:</th><th>Цена:</th><th>Добавяне:</th></tr> -->
            <!-- for($j = 0; $j < count($output); $j++) -->
            <!-- //     echo "<tr><td>" . $output[$j]['name'] . "</td><td>" . $output[$j]['weight'] . "</td><td>" . $output[$j]['price'] . "</td><td><button class='add' food-id='" .  $output[$j]['id_food'] . "' food='" . $output[$j]['name'] . "' weight='" . $output[$j]['weight'] . "' price='" . $output[$j]['price'] ."'>Добави</button></td></tr>"; 
            // }
            </table></div><div class='line'></div>";                                 -->
                            </div>
        @endforeach
    @endif

    <div class="bottom">
        <form class="review-form">
            <input type="hidden" name="id_restaurant" value="<?php //echo $id; ?>" required>
            <h1>Напишете ревю към този ресторант</h1>
            <input type="range" name="rating" id="rating" min="1" max="5" value="1" oninput="this.nextElementSibling.value = this.value + ' звезда/звезди'" required>
            <output id="indicator">1 звезда/звезди</output>
            <textarea name="review-description" id="review" cols="40" rows="10" maxlength="1000" required></textarea>
            <input type="submit" value="Напиши ревю" class="submit-button">
        </form>

        <div class="reviews-div">
            <?php //foreach ($reviews as $key => $value) {
            //echo "<div class='review-" . $value['id_reviews'] . "'>";  ?>
            <?php //echo "<div id='user-info'><i class='fa-solid fa-user'></i><p>" . $value["username"] . "</p>"; ?> 
            <span><?php //echo $value["stars"] . "<i class='fa-solid fa-star' style='color: #ffe234;'></i>"; ?></span> 
            <?php //echo "</div>"; ?>
            <!-- <button id="delete-review">Изтрии ревю</button> -->
            <p><?php //echo $value["review_description"]; ?></p>
            <?php //echo "</div>"; } ?>
        </div>
    </div>

    <footer>
        <div class="footer" style="position: relative;">
            <h3><i class="fa-solid fa-copyright"></i> FoodNow.Inc. All Rights Reserved.</h3>
            <div class="icons">
                <i class="fa-brands fa-facebook"></i>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-twitter"></i>
            </div>
        </div>
    </footer>
</body>
</html>