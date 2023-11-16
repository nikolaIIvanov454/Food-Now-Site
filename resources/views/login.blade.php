<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="{{ asset('js/script_menu.js') }}"></script>
	<script src="https://kit.fontawesome.com/f2264ef78f.js" crossorigin="anonymous" defer></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js" defer></script>	
	<link rel="shortcut icon" href="{{ asset('assets/icon.svg') }}" type="image/x-icon">
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <title>FoodNow - Влизане</title>
</head>
<body>
	<nav class="navbar">
        <div class='navbar-container'>
			<div id="nav-icon" class='navbar-toggle'>
				<span></span>
				<span></span>
				<span></span>
			</div>
        	<ul class="navbar-items">
				<li><img src="{{ asset('assets/icon.svg') }}" alt="icon"></li>
				<li><a href="{{ url('/home') }}">Начална страница</a></li>
                <li><a href="#" class="current">Влизане</a></li>
                <li><a href="{{ url('/register') }}">Регистрация</a></li>
				<li><a href="{{ url('/about-us') }}">За нас</a></li>
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
	<div class="flex center-element v-height center-text">
		<form action="{{ route('login_user') }}" method="post" class="form-style">
            @csrf
			<h1 class="no-margin-top">Влизане в сайта:</h1>
			<input type="text" class="margin-top-sm margin-bot-sm inputs" name="info" id="user" required placeholder="Потребителско име / E-Mail">
			<input type="password" class="margin-top-sm margin-bot-sm inputs" name="password" id="pass" required placeholder="Парола">
			<input type="submit" class="border-radius margin-top-sm submit" value="Влизане">
			<a href="{{ url('/register') }}" class="margin-top-sm">Регистрация</a>
			<a href="{{ route('password_reset') }}" class="margin-top-sm">Забравена парола?</a>
		</form>
	</div>

	@include('components.footer', ['dynamic_content' => 'position: relative;'])
</body>
</html>