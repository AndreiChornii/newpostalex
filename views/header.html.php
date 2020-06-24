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
                <?php if(empty($currentUser['login'])){ ?>
                <li><a class="header__link<?php if($route === '/') {echo ' active';} ?>" href="/">Login</a></li>
                <?php } ?>
                <li><a class="header__link<?php if($route === '/registration') {echo ' active';} ?>" href="/registration">Registration</a></li>
                <?php if(!empty($currentUser['login'])){ ?>
                <li><a class="header__link<?php if($route === '/documents') {echo ' active';} ?>" href="/documents">Documents</a></li>
                <?php } ?>
                <?php if(!empty($currentUser['login'])){ ?>
                <li><a class="header__link<?php if($route === '/logout') {echo ' active';} ?>" href="/logout">Logout</a></li>
                <?php } ?>
                <li><b><?php if(!empty($currentUser['login'])) echo "Welcome: " . $currentUser['login'] ?></b></li>
            </ul>
        </nav>
    </header>
    <div class="hamburger-menu">
        <input id="menu__toggle" type="checkbox" />
        <label class="menu__btn" for="menu__toggle">
            <span></span>
        </label>  
        <ul class="menu__box">
            <?php if(empty($currentUser['login'])){ ?>
                <li><a class="header__link" href="/">Login</a></li>
            <?php } ?>
                <li><a class="header__link" href="/registration">Registration</a></li>
            <?php if(!empty($currentUser['login'])){ ?>
                <li><a class="header__link" href="/documents">Documents</a></li>
            <?php } ?>
            <?php if(!empty($currentUser['login'])){ ?>
                <li><a class="header__link" href="/logout">Logout</a></li>
            <?php } ?>
                <li><b><?php if(!empty($currentUser['login'])) echo "Welcome: " . $currentUser['login'] ?></b></li>
        </ul>
    </div>
    <main class="page">