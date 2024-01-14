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