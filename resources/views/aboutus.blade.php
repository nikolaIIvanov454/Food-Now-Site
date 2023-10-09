<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/f2264ef78f.js" crossorigin="anonymous" defer></script>
	<script src="scripts/script_menu.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js" defer></script>
	<link rel="stylesheet" href="{{ asset('css/aboutus-style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/menu.css') }}">
	<link rel="shortcut icon" href="{{ asset('assets/icon.svg') }}" type="image/x-icon">
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
				<li><a href="home.php">Начална страница</a></li>
				<li><a href="{{ url('/login') }}">Влизане</a></li><li>
                <li><a href="{{ url('/register') }}">Регистрация</a></li>
				<li><a href="#" class="current">За нас</a></li>
				<?php //if(isset($_SESSION['is_Admin']) && $_SESSION['is_Admin'] == "true"){
					//echo "<li><a href='admin.php'>Администраторски панел</a></li>";
				//} ?>
				<li id="float-r">
					<div class="logout">
						<i class="fa-solid fa-circle-user" style="font-size: 3em; margin: 0.2em 0.2em; color: #fff;"></i>
						<?php 
						// if(isset($_SESSION['logged_user'])){
						// 	echo "<h1 style='color: #fff; margin-right: 10px; float: left; text-transform: capitalize;'>" . $_SESSION['logged_user'] . "</h1>";
						// }else{
						// 	echo "<h1 style='color: #fff; float: left; margin-right: 10px; text-transform: capitalize;'>Not Logged    </h1>"; 
						// }?>
					</div>
					<?php 
						// if(isset($_SESSION['logged_user'])){
						// 	echo "<a href='logout.php'>Излизане</a>"; 
						// }
					?>
				</li>
        	</ul>
		</div>
    </nav>

	<div id="wrapper">
		<div id="images">
				<img src="{{ asset('assets/aboutus_photos/image1.png'); }}" alt="pizza">
				<img src="{{ asset('assets/aboutus_photos/image2.avif'); }}" alt="wine_glass">
				<img src="{{ asset('assets/aboutus_photos/image3.jpg'); }}" alt="icecream">
				<img src="{{ asset('assets/aboutus_photos/image4.jpg'); }}" alt="salad">
		</div>

		<div id="content">
			<h1>Кои сме ние?</h1>
			<p>Нашият сайт предлага различни вериги ресторанти, които съчетават в себе си разнообразно меню от вкусни традиционни и нехарактерни за нашия регион ястия. Обслужването е бързо и корекно. Тук можете да намерите голям асортимент от предястия, основни ястия и вдъхновяващи десрти. Нашата цел е максимално удоветволяване желанията и нуждите на нашите клиенти!</p>
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