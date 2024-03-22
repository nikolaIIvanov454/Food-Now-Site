<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- download library using npm and use that instead -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('js/script_menu.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js" defer></script>
    <link rel="shortcut icon" href="{{ asset('assets/icon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
      <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">


    <title>FoodNow - Регистрация</title>
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
			<li><a href="{{ url('/login') }}">Влизане</a></li>
            <li><a href="#" class="current">Регистрация</a></li>
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
        <form action="{{ route('register_user') }}" method="post" class="form-style">
            @csrf
            <h1 class="no-margin-top break-words">Регистрация в сайта</h1>
            <div class="input"><i class="fa-solid fa-user"></i><input type="text" class="inputs" name="username" id="user" placeholder="Потребителско име" value="{{ old('username') }}" required></div>
            @if($errors->has('username'))
                <div id="error">{{ $errors->first('username') }}</div>
            @endif
            <div class="input"><i class="fa-solid fa-envelope"></i><input type="email" class="inputs" name="email" id="mail" placeholder="E-mail" value=" {{ old('email') }}" required></div>
            @if($errors->has('email'))
                <div id="error">{{ $errors->first('email') }}</div>
            @endif
            <div class="input"><i class="fa-solid fa-lock"></i><input type="password" class="inputs" name="password" id="pass" placeholder="Парола" required></div>
            @if($errors->has('password'))
                <div id="error">{{ $errors->first('password') }}</div>
            @endif
            <div class="input"><i class="fa-regular fa-lock"></i><input type="password" class="inputs" name="confirm-password" id="confirm"  placeholder="Повторете паролата" required></div>
            @if($errors->has('confirm-password'))
                <div id="error">{{ $errors->first('confirm-password') }}</div>
            @endif
            <input type="submit" class="border-radius submit" value="Регистрация">
            <a href="{{ url('/login') }}">Вече имате регистрация?</a>
        </form>
    </div>

    @include('components.footer', ['dynamic_content' => 'position: relative;'])
</body>
</html>
