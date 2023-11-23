<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Забравена парола</title>
    <link rel="shortcut icon" href="{{ asset('assets/icon.svg') }}" type="image/x-icon">
    <script src="https://kit.fontawesome.com/f2264ef78f.js" crossorigin="anonymous" defer></script> 
    <link rel="stylesheet" href="{{ asset('css/pass_reset.css') }}">
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
                        <i class='fa-solid fa-circle-user' style='font-size: 3em; color: #fff;'></i>    
                        @if(session()->has('logged_username'))
							<h1 style='color: #fff; width: min-content; margin-left: 5px; text-transform: capitalize;'>{{ session('logged_username') }}</h1>
                            <a href="{{ route('logout') }}">Излизане</a>
                        @else
							<h1 style='color: #fff; margin-left: 5px;'>Не сте влезли</h1>
						@endif
                    </div>
                </li>
            </ul>
        </div>
        </nav>
    </header> 

    <div class="form">
        <div class="container">
            @if(session('message'))
                <h1>{{ session('message') }}</h1>
            @endif
            <h1>Променяне на паролата</h1>
            <form action="{{ route('send_password_reset') }}" method="post">
                @csrf
                <label for="email">Въведете имейл за въстановяване на паролата:</label>
                <input type="email" name="email" id="email" required>
                <input type="submit" class="button" value="Изпращане на линк!">
            </form>
        </div>
    </div>
</body>
</html>