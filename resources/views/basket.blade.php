<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Количка</title>
    <script src="https://kit.fontawesome.com/f2264ef78f.js" crossorigin="anonymous" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js" defer></script>
    <script src="{{ asset('js/script_menu.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <style>
        #container{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            border: 2px solid black;
            border-radius: 16px;
            width: 90%;
            margin: auto;
        }

        #item{
            text-align: center;
            font-size: 25px;
        }

        #item table, th, td{
            border: 2px solid black;
            border-collapse: collapse;
        }

        #item th:nth-child(odd), #item tfoot tr th:last-child{
            background-color: rgba(246, 103, 48, 0.7);
        }

        #item td:nth-child(odd){
            background-color: rgba(246, 103, 48, 0.5);
        }

        #item td:last-child{
            background-color: white;
        }

        #item table th, td{
            padding: 15px;
        }

        i[class*=fa-xmark]{
            display: flex; 
            justify-content: center; 
            align-items: center; 
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
        }
    </style>
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
    @if($basket_items->Count() > 0)
    <div id="item">
        <table>
                <thead>
                    <tr>
                        <th>Вид храна:</th>
                        <th>Цена:</th>
                        <th>Брой:</th>
                        <th>Грамаж:</th>
                        <th>Изтриване:</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($basket_items as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ $item->options->weight }}</td>
                            <td style="padding: 0;">
                                <form action="{{ route('remove-item') }}" id="remove" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->rowId }}">
                                    <i class="fa-solid fa-xmark" onclick="document.getElementById('remove').submit()"></i>
                                </form>
                            </td>
                        </tr>
                @endforeach
                </tbody>

                @php
                $totalPrice = 0;
                foreach($basket_items as $item) {
                    $totalPrice += $item->price * $item->qty;
                }   
                @endphp

                <tfoot>
                    <tr>
                        <th colspan=5>Обща цена: {{ $totalPrice }}</th>
                    </tr>
                </tfoot>
        </table>
    </div>
    @else
        <h1>Нямате продукти в количката!</h1>
    @endif
    </div>
</body>
</html>