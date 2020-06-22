<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>new_post</title>
</head>

<body>
    <header class="header">
        <nav>
            <ul class="header__menu">
                <li><a class="header__link" href="/">Login</a></li>
                <li><a class="header__link" href="/registration">Registration</a></li>
                <?php if(!empty($currentUser['username'])){ ?>
                <li><a class="header__link" href="/ttn">ТТН</a></li>
                <?php } ?>
                <li><b><?= $currentUser['username'] ?></b></li>
            </ul>
        </nav>
    </header>
    <main class="page">