<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="scripts/script_menu.js"></script>
    <script src="https://kit.fontawesome.com/f2264ef78f.js" crossorigin="anonymous" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js" defer></script>
    <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="v{{ asset('css/menu.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/icon.svg') }}" type="image/x-icon">
    <title>FoodNow - Администраторски панел</title>
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
			@if(!session()->has('logged_username'))
                <li><a href="{{ url('/login') }}">Влизане</a></li>
                <li><a href="{{ url('/register') }}">Регистрация</a></li>
            @endif
			<li><a href="{{ url('about-us') }}">За нас</a></li>
			@auth
                @if(auth()->user()->isAdmin())
                    <li><a href='{{ url('/admin') }}' class="current">Администраторски панел</a></li>
                @endif
            @endauth
			<li id="float-r">
                <div class="logout">
                    @if(session()->has('logged_username'))
                        <i class='fa-solid fa-circle-user' style='font-size: 3em; color: #fff;'></i><h1 style='color: #fff; width: min-content; margin-left: 5px; text-transform: capitalize;'>{{ session('logged_username') }}</h1>
                        <a href="{{ route('logout') }}">Излизане</a>
                    @endif
                </div>
            </li>
        </ul>
    </nav>

    <div class="errors">
        <?php if(isset($_SESSION['errors'])){ echo "<h1>" . $_SESSION['errors'] . "</h1>"; } ?>
    </div>
    <div class="add-form">
        <form action="scripts/admin/handleAdding.php" method="post">
            <h3 class="margin-bot-sm">Добавяне на ресторанти:</h3>
            <label for="name_restaurant">Име на ресторанта:</label>
            <input type="text" name="name" class="margin-bot-sm inputs" id="name_restaurant" required>
            <label for="image_restaurant">Път до снимка:</label>
            <input type="file" name="image" class="margin-bot-sm" id="image_restaurant" accept="image/*">
            <label for="description_restaurant">Описание за ресторанта:</label>
            <textarea name="description" class="margin-bot-sm desc" style="resize: none;" id="description_restaurant" cols="30" rows="10" required></textarea>
            <label for="price_restaurant">Ценови диапазон на ресторанта:</label>
            <input type="text" class="margin-bot-sm inputs" name="price" id="price_restaurant" required>
            <label for="region_restaurant">Регион на ресторанта:</label>
            <input type="text" class="inputs" name="region" id="region_restaurant" required>
            <input type="submit" class="margin-top-sm" value="Добавяне">
        </form>

        <form action="scripts/admin/handleRemove.php" method="post">
            <h3 class="margin-bot-sm">Премахване на ресторанти:</h3>
            <label for="name_restaurant">Име на ресторанта:</label>
            <input type="text" class="inputs" name="name_to_delete" id="name_restaurant" required>
            <input type="submit" class="margin-top-sm" value="Премахване">
        </form>
        
        <form action="scripts/admin/handleRemoveUser.php" method="post">
            <h3 class="margin-bot-sm">Премахване на потребители:</h3>
            <label for="name_user">Име на потребителя:</label>
            <input type="text" class="inputs" name="username" id="name_user" required>
            <input type="submit" class="margin-top-sm" value="Премахване">
        </form>
    </div>
    
    @include('components.footer')
</body>
</html>