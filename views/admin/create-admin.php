<!doctype html>

<html>

<head>
    <title>Регистрация</title>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">

    <style>
        @import "/resources/css/styles.css";
    </style>
</head>

<body>

<header>
    <ul>
        <li><a href="#">Главная</a></li>
        <li><a href="#">Товары</a></li>
        <li><a href="#">Корзина</a></li>
        <li><a href="#">О нас</a></li>
    </ul>
</header>

<h1 class="title">Регистрация нового администратора</h1>

<form action="" method="post">
    <ul>
        <li>
            <label for="login">Логин:</label>
            <input type="text" name="login">
        </li>

        <li>
            <label for="password">Пароль:</label>
            <input type="password" name="password">
        </li>

        <li>
            <label for="repeatPassword">Повторите пароль:</label>
            <input type="password" name="repeatPassword">
        </li>
    </ul>

    <button class="submit" type="submit">Отправить</button>
</form>

</body>

</html>
