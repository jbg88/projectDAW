<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Learn To Play</title>
    <link rel="stylesheet" href="css/header_home_footer.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/games.css">
    <link rel="stylesheet" href="css/ds1.css">
    <link rel="stylesheet" href="css/management.css">
    <link rel="stylesheet" href="css/adminreg.css">
</head>
<body>

<header>
    <h2 class="headerTitle">Learn To Play</h2>
    <!-- Menu navegacion -->
    <h2 class="headerWelcome">
        <?php
        if (!empty($_SESSION['user'])) {
            echo 'Welcome ' . htmlspecialchars($_SESSION['user']['nick']);//para evitar que metan cosas extrañas en la url
            echo '. You are an ' . ($_SESSION['user']['rol'] === 'user' ? 'user' : 'admin') . '.';
        }
        ?>
    </h2>
    <nav>
        <ul>
            <li><a title="home" href="index.php?p=home">Home</a></li>
            <li><a title="games" href="index.php?p=games">Games</a></li>
            <li><a title="contact" href="index.php?p=contact">Contact</a></li>
            <!-- si no se ha iniciado sesion aparecen las opciones para loguearse o registrarse-->
            <?php if (empty($_SESSION['user'])): ?>
                <li><a title="login" href="index.php?p=login">Log In</a></li>
                <li><a title="register" href="index.php?p=register">Register</a></li>
                <!-- si se ha iniciado sesion aparecen las opciones de favoritos y desloguearse, además de la
                opción de management si eres un administrador-->
            <?php else: ?>
                <li><a title="favorites" href="index.php?p=favorites">Favorites</a></li>
                <?php if ($_SESSION['user']['rol'] === 'admin'): ?>
                    <li><a title="management" href="index.php?p=management">Management</a></li>
                <?php endif ?>
                <li><a title="logout" href="index.php?p=logout">Log Out</a></li>
            <?php endif ?>
        </ul>
    </nav>
    <!-- Menu navegacion -->
</header>
