<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Количка</title>
    <script src="https://kit.fontawesome.com/f2264ef78f.js" crossorigin="anonymous" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js" defer></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('js/script_menu.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    <style>
        #container{
            display: flex;
            flex-direction: column;
            border: 2px solid black;
            border-radius: 16px;
            width: 90%;
            margin: auto;
            padding: 10px;
        }

        #left-content{
            display: flex;
            align-items: center;
        }

        #name{
            display: flex;
            justify-content: center;
        }

        #complete-order{
            display: none;
        }

        #complete-order input{
            background-color: #f6673c;
            color: white;
            border-radius: 1em;
            padding: 5px;
            border-color: #333;
            transition: color, background-color 0.5s ease;
            cursor: pointer;
        }

        #complete-order input:hover{
            background-color: white;
            color: #333;
        }

        #name h1{
            width: fit-content; 
            font-weight: bolder; 
            border-bottom: 2px groove #333; 
            margin-bottom: 20px;
        }

        #item{
            display: flex;
            justify-content: space-between;
            gap: 10px;
            padding: 0 10px 10px 10px;
            border-bottom: 1px solid #ccc;
        }

        #total{
            display: flex;
            justify-content: center;
            margin-bottom: 15px;
        }

        #total h1{
            font-size: 2rem;
        }

        #buttons-container{
            display: flex; 
            justify-content: flex-end; 
            align-items: center; 
            flex: 1;
            width: 25%;
        }

        #complete-order{
            display: flex;
            justify-content: center;
        }

        i[class*=fa-xmark]{
            display: flex; 
            justify-content: center; 
            align-items: center; 
            width: 200px;
            color: #ff1f1f;
            padding: 18px;
            border: 2px solid red;
            background-color: white;
            border-radius: 16px;
            transition: all 200ms ease-in-out;
        }

        i[class*=fa-xmark]:hover{
            border-color: white;
            background-color: red;
            color: white;
            cursor: pointer;
        }

        @media (max-width: 1035px) {
            #container {
                width: 100%; 
            }

            #item {
                flex-direction: column; 
                align-items: center;
            }

            #buttons-container {
                width: 100%; 
                justify-content: center; 
                margin-top: 10px; 
            }
        }
    </style>
    <script>
        let checkout = (event) =>{
            let form = document.getElementById('checkout-form');
            event.preventDefault();

            let formData = new FormData(form);

            $.ajax({
                type: "POST",
                url: "/checkout",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    swal("Успешно завършване на поръчката", "", "success");

                    setTimeout(function() {
                        form.submit();
                    }, 2500); 
                },
                error: function (message) {
                    swal("Възникна проблем", "", "error");
                }
            });
        }
    </script>
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
                        <div id="icon">
                            <i class="fas fa-shopping-cart" style="font-size: 2em; color: #fff;"></i>
                            <span class="count-items" style="font-size: 0.8em; padding: 5px 5px; background-color: rgb(246, 103, 48); border-radius: 16px; color: white; position: relative; top: -20px; right: 9px;">{{ $basket_items->Count() }}</span>
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

    <div id="container">
    <div id="name">
        <h1>Моята количка</h1>
    </div>
    @if($basket_items->Count() > 0)
        @foreach($basket_items as $item)
        <div id="item">
                <div id="left-content">
                    <h1>{{ $item->name }}</h1>
                </div>
                <div id="right-content">
                    <h3>Грамаж: {{ $item->options->weight }}</h3>
                    <h3>Количество: {{ $item->qty }}</h3>
                    <strong>Цена: {{ $item->price }}</strong>
                </div>
                <div id="buttons-container">
                    <form action="{{ route('remove-item') }}" id="remove" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->rowId }}">
                        <i class="fa-solid fa-xmark" onclick="document.getElementById('remove').submit()"></i>
                    </form>
                </div>
            </div>

            @php
                $totalPrice = 0;
                foreach($basket_items as $item) {
                    $totalPrice += $item->price * $item->qty;
                }   
            @endphp
        @endforeach

        <div id="total">
            <h1>Обща Цена: {{ $totalPrice }}</h1>
        </div>

        <div id="complete-order">
            <form id="checkout-form">
                @csrf
                <input type="hidden" name="items-total-price" value="{{ $totalPrice }}">
                <input type="hidden" name="items" value="{{ $basket_items }}">
                <input type="submit" onclick="checkout(event)" style="display: flex; align-items: center;" value="Завърши поръчката">
            </form>
        </div>
    @else
        <h1 style="text-align: center;">Нямате продукти в количката!</h1>
    @endif
    </div>

    @include('components.footer')
</body>
</html>