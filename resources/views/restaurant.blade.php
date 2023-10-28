<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/f2264ef78f.js" crossorigin="anonymous" defer></script>
    <script src="{{ asset('js/shopping_cart.js') }}" defer></script>
    <script src="{{ asset('js/script_menu.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js" defer></script>
    <script src="{{ asset('js/sendReview.js') }}" defer></script>
    <script src="{{ asset('js/handleDeletion.js') }}"></script>
    <link rel="shortcut icon" href="{{ asset('assets/icon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/home-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <script>
        
    </script>
    <title>FoodNow - Ресторант: @if(isset($loaded_restaurant)) {{ $loaded_restaurant->name }} @else {{ "Restaurant" }} @endif</title>
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
                @auth
                    @if(auth()->user()->isAdmin())
                        <li><a href='{{ url('/admin') }}'>Администраторски панел</a></li>
                    @endif
                @endauth
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

    @if(isset($loaded_restaurant))
           <div class='container'>
            <input type='hidden' class='id' name='id' value="{{ $loaded_restaurant->id }}">
            <div class='left-div'><div class='center-text'><h1>{{ $loaded_restaurant->name }}</h1></div>
            <div class='image-div'><img src="{{ $loaded_restaurant->image_path }}"></div></div>
            <div class='right-div'><div class='center-text desc-clicked'><p>{{ $loaded_restaurant->description }}</p></div>
            <div class='center-text'><h2>{{ $loaded_restaurant->price }}</h2></div></div></div><div class='line'></div>
            <div class='products'>
                <h1>Меню:</h1>
                <h2>Какво предлага ресторанта.</h2>
                <table>
                    <tr>
                        <th>Тип Храна:</th>
                        <th>Грамаж:</th>
                        <th>Цена:</th>
                        <th>Добавяне:</th>
                    </tr> 
                        @foreach($loaded_menu as $food)
                            <tr>
                                <td>{{ $food->name }}</td><td>{{ $food->weight }}</td><td>{{ $food->price }}</td><td><button class='add' food-id='{{ $food->id_food }}' food='{{ $food->name}}' weight='{{ $food->weight }}' price='{{ $food->price }}'>Добави</button></td>
                            </tr>
                        @endforeach
                </table>
            </div>
            <div class='line'></div>
    @endif

    <div class="bottom">
        <form class="review-form">
            @csrf
            <input type="hidden" name="id_restaurant" value="{{ $loaded_restaurant->id }}" required>
            <h1>Напишете ревю към този ресторант</h1>
            <input type="range" name="rating" id="rating" min="1" max="5" value="1" oninput="this.nextElementSibling.value = this.value + ' звезда/звезди'" required>
            <output id="indicator">1 звезда/звезди</output>
            <textarea name="review-description" id="review" cols="40" rows="10" maxlength="1000" required></textarea>
            <input type="submit" value="Напиши ревю" class="submit-button">
        </form>

        <div class="reviews-div">
            @if(isset($loaded_reviews))
                @foreach($loaded_reviews as $review)
            <div class='review-{{ $review->id_review }}'>
                <div id='user-info'><i class='fa-solid fa-user'></i><p>{{ $review->username }}</p>
                    <span>{{ $review->stars }}<i class='fa-solid fa-star' style='color: #ffe234;'></i></span> 
                </div>
                <p>{{ $review->review_description }}</p>
            </div>
                @endforeach
            @endif  
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