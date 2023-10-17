<?php 
// session_start();

// if ($_SESSION['is_Admin'] == "false" || $_SESSION['is_Admin'] == null) {
// 	header("location: home.php");
// 	exit;
// }

?>

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
    <link rel="stylesheet" href="styles/admin-style.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/menu.css">
    <link rel="shortcut icon" href="restaurant_photos/icon/icon.svg" type="image/x-icon">
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
            <li><img src="restaurant_photos/icon/icon.svg" alt="icon"></li>
            <li><a href="home.php">Начална страница</a></li>
			<?php if(!isset($_SESSION['logged_user'])){ 
            echo "<li><a href='login.php'>Влизане</a></li><li><a href='register.php'>Регистрация</a></li>";
            } ?>
			<li><a href="aboutus.php">За нас</a></li>
			<?php if(isset($_SESSION['is_Admin']) && $_SESSION['is_Admin'] == "true"){
				echo "<li><a class='current' href='admin.php'>Администраторски панел</a></li>";
			} ?>
			<li id="float-r">
                <div class="logout">
                    <i class="fa-solid fa-circle-user" style="font-size: 3em; margin: 0.2em 0.2em; color: #fff;"></i>
                    <?php 
					if(isset($_SESSION['logged_user'])){
                        echo "<h1 style='color: #fff; margin: 0; float: left; margin-right: 10px; text-transform: capitalize;'>" . $_SESSION['logged_user'] . "</h1>";
                    }else{
                        echo "<h1 style='color: #fff; margin: 0; float: left; margin-right: 10px; text-transform: capitalize;'>Not Logged</h1>"; 
                    }?>
                </div>
                <?php if(isset($_SESSION['logged_user'])){
                    echo "<a href='logout.php'>Излизане</a>";
                }?>
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
    
    <footer>
        <div class="footer">
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