<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>newpostalex</title>
</head>

<body>
    <header class="header">
        <nav>
            <ul class="header__menu">
                <li><a class="header__link<?php if( ($route === '/') and (empty($currentUser['login']))) {echo ' active';} ?>" href="/">Login</a></li>
                <li><a class="header__link<?php if($route === '/registration') {echo ' active';} ?>" href="/registration">Registration</a></li>
                <?php if(!empty($currentUser['login'])){ ?>
                <li><a class="header__link<?php if($route === '/ttn') {echo ' active';} ?>" href="/ttn">ТТН</a></li>
                <?php } ?>
                <?php if(!empty($currentUser['login'])){ ?>
                <li><a class="header__link<?php if($route === '/logout') {echo ' active';} ?>" href="/logout">Logout</a></li>
                <?php } ?>
                <li><b><?php if(!empty($currentUser['login'])) echo "Welcome: " . $currentUser['login'] ?></b></li>
            </ul>
        </nav>
    </header>
    <main class="page">