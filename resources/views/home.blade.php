<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ресторанти</title>
    <script src="{{ asset('js/script_filter.js') }}" defer></script>
    <script src="{{ asset('js/script_menu.js') }}"></script>
    <script src="https://kit.fontawesome.com/f2264ef78f.js" crossorigin="anonymous" defer></script> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js" defer></script>
    <link rel="shortcut icon" href="{{ asset('assets/icon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home-style.css') }}">
</head>
<body class='body'>
    <nav class="navbar">
        <div class='navbar-container'>
            <div id="nav-icon" class='navbar-toggle'>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="navbar-items">   
                <li><img src="{{ asset('assets/icon.svg') }}" alt="icon"></li>
                <li><a href="#" class="current">Начална страница</a></li>

                <!-- TODO: check if the user is logged in the HomeController -->

                <!-- <li><a href="{{ url('/login') }}">Влизане</a></li>
                <li><a href="{{ url('/register') }}">Регистрация</a></li> -->

                <li><a href="{{ url('/about-us') }}">За нас</a></li>

                <!-- TODO: here also -->

                <?php //if(isset($_SESSION['is_Admin']) && $_SESSION['is_Admin'] == "true"){
                    //echo "<li><a href='admin.php'>Администраторски панел</a></li>";
                //} ?>
                
                <li id="float-r">
                    <div class="logout">
                        <?php //echo "<i class='fa-solid fa-circle-user' style='font-size: 3em; color: #fff;'></i><h1 style='color: #fff; width: min-content; margin-left: 5px; text-transform: capitalize;'>" . $_SESSION['logged_user'] . "</h1>"; ?>
                    </div>
                    <!-- <a href="logout.php">Излизане</a> -->
                </li>
            </ul>
        </div>
    </nav>

    <div class="all">
        <div class="filter">
            <h1><strong>ДОБРЕ ДОШЛИ!</strong></h1>
            <h2>Моля изберете област:</h2>
            <!-- use back() function in controller not home.php -->
            <form action="{{ route('restaurant-list') }}" method="post" style="display: inline-block;">
                @csrf
                <select name="oblast" id="oblast"></select>
                <input type="submit" value="Filter">
            </form> 
        </div>

    <div class='item-shell'>

    <?php
        // if(isset($_POST['oblast'])){
        //     for($i = 0; $i < count($result); $i++){
        //         echo "<div class='item' onclick='showRestaurant(this)'>";
        //         echo "<form method='POST' action='templates/template_restaurant.php'><input type='hidden' id='id_restaurant-" . $result[$i]['id_restaurant'] . "' name='id' value='" . $result[$i]['id_restaurant'] . "'></form>";
        //         echo "<input type='hidden' id='id_restaurant-" . $result[$i]['id_restaurant'] . "' name='id' value='" . $result[$i]['id_restaurant'] . "'>";
        //         echo "<div class='padding-sm center-text new-line'><h1>" . $result[$i]['name'] . "</h1></div>";
        //         echo "<div class='image'><img src=" . $result[$i]["image_path"] . " class='photo'></div>";
        //         echo "<div class='padding-sm center-text'><h2>" . $result[$i]['price'] . "</h2><button id='favourite'><i class='fa-regular fa-heart'></i></button></div>"; 
        //         echo "</div>";           
        //     }                               
        // }
    ?>
    </div>
    </div>
    
    <footer>
        <div class="footer">
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