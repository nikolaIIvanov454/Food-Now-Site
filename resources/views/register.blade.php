<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- download library using npm and use that instead -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://kit.fontawesome.com/f2264ef78f.js" crossorigin="anonymous" defer></script>
    <script src="{{ asset('js/script_menu.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js" defer></script>
    <link rel="shortcut icon" href="{{ asset('assets/icon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
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
            <li><a href="home.php">Начална страница</a></li>
			<li><a href="{{ url('/login') }}">Влизане</a></li>
            <li><a href="#" class="current">Регистрация</a></li>
            <li><a href="{{ url('/about-us') }}">За нас</a></li>
            <?php //session_start(); if(isset($_SESSION['is_Admin']) && $_SESSION['is_Admin'] == "true"){
				//echo "<li><a href='admin.php'>Администраторски панел</a></li>";
			//} ?>
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
    </nav>

	<div class="flex center-element v-height center-text">
        <form action="{{ route('register_user') }}" method="post" class="form-style">
            @csrf
            <div class="errors">
                <?php 
                    // if(isset($_SESSION['errors'])){ 
                    //     foreach($_SESSION['errors'] as $value){
                    //         echo "<h1 class='break-words'>" . $value . "</h1>"; 
                    //     } 
                    // } 
                    // unset($_SESSION['errors']); 
                ?>
            </div>
            <h1 class="no-margin-top break-words">Форма за Регистрация</h1>
            <input type="text" class="margin-top-sm margin-bot-sm inputs" name="username" id="user" required placeholder="Потребителско име">
            <input type="email" class="margin-top-sm margin-bot-sm inputs" name="email" id="mail" required placeholder="E-mail">
            <input type="password" class="margin-top-sm margin-bot-sm inputs" name="password" id="pass" required placeholder="Парола">
            <input type="password" class="margin-top-sm margin-bot-sm inputs" name="confirm-password" id="confirm"  required placeholder="Повторете паролата">
            <input type="submit" class="border-radius margin-top-sm submit" value="Регистрация">
            <a href="{{ url('/login') }}" class="margin-top-sm">Вече имате регистрация?</a>
        </form>
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