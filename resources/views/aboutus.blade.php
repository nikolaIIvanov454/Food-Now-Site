<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/f2264ef78f.js" crossorigin="anonymous" defer></script>
	<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js" defer></script>
	<script src="{{ asset('js/script_menu.js') }}"></script>
	<script src="{{ asset('js/carousel.js') }}" defer></script>
	<link rel="stylesheet" href="{{ asset('css/aboutus-style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/menu.css') }}">
	<link rel="shortcut icon" href="{{ asset('assets/icon.svg') }}" type="image/x-icon">
	<style>
		.carousel{
			display: flex;
			flex-direction: column;
			justify-content: center;
		}

		.splide__pagination {
			position: relative;
			background-color: transparent;
			transform: translateY(-80%);
		}
		
		.splide__pagination__page.is-active {
			background-color: #F6673C;
		}	
		
		#images {
			max-width: 100%;
			margin: 0 auto;
			padding: 0 20px;
    	}

		.splide__slide {
			display: flex;
			justify-content: center;
			align-items: center;
			text-align: center;
			width: calc(100%) !important; 
		}

		.splide__slide img {
			max-width: 100%;
			max-height: 100%;
			object-fit: contain;
			height: auto;
			width: auto;
		}

		.splide {
			background-color: transparent; 
		}

		.splide__arrow {
			top: 50%; 
		}

		@media screen and (max-width: 768px) {
			.splide__slide {
				height: 250px; 
			}
		}

		@media screen and (max-width: 576px) {
			.splide__slide {
				height: 200px; 
			}
		}
	</style>
	<title>FoodNow - About Us</title>
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
				<li><a href="#" class="current">За нас</a></li>
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

	<div id="wrapper">
		<div id="images">
			<div class="carousel">
				<section class="splide" aria-label="Placeholder Example">
					<div class="splide__track">
						<ul class="splide__list">
							<li class="splide__slide">
								<img src="{{ asset('assets/aboutus_photos/image1.png'); }}" alt="pizza">
							</li>
							<li class="splide__slide">
								<img src="{{ asset('assets/aboutus_photos/image2.avif'); }}" alt="wine_glass">
							</li>
							<li class="splide__slide">
								<img src="{{ asset('assets/aboutus_photos/image3.jpg'); }}" alt="icecream">
							</li>
							<li class="splide__slide">
								<img src="{{ asset('assets/aboutus_photos/image4.jpg'); }}" alt="salad">
							</li>
						</ul>
					</div>
				</section>
			</div>
		</div>
					
		<div id="content">
			<h1>Кои сме ние?</h1>
			<p>Нашият сайт предлага различни вериги ресторанти, които съчетават в себе си разнообразно меню от вкусни традиционни и нехарактерни за нашия регион ястия. Обслужването е бързо и корекно. Тук можете да намерите голям асортимент от предястия, основни ястия и вдъхновяващи десерти. Нашата цел е максимално удовлетворяване желанията и нуждите на нашите клиенти!</p>
		</div>

		<div id="contact">
			<div id="phone">
				<i class="fa-solid fa-phone"></i>
				<h3>Телефон за връзка: +3598805321367</h3>
				<h3>Телефон за поръчки: +359895784312</h3>
			</div>
			<div id="working-time">
				<i class="fa-solid fa-business-time"></i>
				<h3>от 9:00 до 23:00 часа.</h3>
			</div>
		</div>
	</div>

	@include('components.footer', ['dynamic_content' => 'position: relative;'])
</body>
</html>