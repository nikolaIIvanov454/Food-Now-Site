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
    <script src="{{ asset('js/rating-slider.js') }}" defer></script>
    @vite('resources/js/app.js')
    <link rel="shortcut icon" href="{{ asset('assets/icon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/home-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
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
                        @php
                            $items_number = Cart::instance('basket')->Count()
                        @endphp
                        <div id="icon">
                            <form action="{{ route('basket-page') }}" method="get" id='cart'></form>
                            <span class="count-items" style="font-size: 0.8em; padding: 5px 5px; background-color: rgb(246, 103, 48); border-radius: 16px; color: white; position: relative; top: -9px; right: 9px;">{{ $items_number }}</span>
                            <i class="fas fa-shopping-cart" style="font-size: 2em; color: #fff;"></i>
                        </div>
                        @if(session()->has('logged_username'))
                            <i class='fa-solid fa-circle-user' style='font-size: 3em; color: #fff;'></i><h1 style='color: #fff; width: min-content; margin-left: 5px; text-transform: capitalize;'>{{ session('logged_username') }}</h1>
                            <a href="{{ route('logout') }}">Излизане</a>
                        @endif
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
            <div id='price-div'><h2>{{ $loaded_restaurant->price }}</h2></div></div></div><div class='line'></div>
            <div class='products'>
                <h1>Меню:</h1>
                <h2>Какво предлага ресторантът.</h2>
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
        </div>
    @endif

    <div class="bottom">
        <form class="review-form">
            @csrf
            <input type="hidden" name="id_restaurant" value="{{ $loaded_restaurant->id }}" required>
            <input type="hidden" name="rating" value="1" required>
            <h1>Напишете ревю към този ресторант</h1>
            <div id="rating-slider">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
            </div>
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

    @include('components.footer', ['dynamic_content' => 'position: relative;'])
</body>
</html>