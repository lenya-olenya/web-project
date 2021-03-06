<!doctype html>

<html>

<?php

require_once ROOT . '/templates/Head.php';
require_once ROOT . '/templates/HeaderPanel.php';

$title = 'Регистрация нового администратора';

$head = new Head('Регистрация');
$headerPanel = new HeaderPanel();

$head->addStyle(Application::SITE_FONTS);
$head->addStyle(Application::SITE_STYLES);
$head->addScript('/resources/js/jquery-1.12.4.js');
//$head->addScript('/resources/js/password-matches.js');

?>

<?= $head->render() ?>

<body>

<?= $headerPanel->render() ?>

<h1 class="title"><?= $title; ?></h1>

<form id="signUpForm" action="/admin" method="post" style="opacity: 0.8">
  <ul>
    <li>
      <label for="login">Логин:</label>
      <input type="text" name="login" required>
    </li>

    <li>
      <label for="password">Пароль:</label>
      <input type="password" name="password" id="password" required>
    </li>

    <li>
      <label for="repeatPassword">Повторите пароль:</label>
      <input type="password" name="confirmPassword" id="confirmPassword" required>
    </li>
  </ul>

  <button class="submit" type="submit" id="submit">Отправить</button>
</form>

</body>

</html>
