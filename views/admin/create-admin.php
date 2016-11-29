<!doctype html>

<html>

<?php

require_once ROOT . '/templates/Head.php';
require_once ROOT . '/templates/HeaderPanel.php';

$title = 'Регистрация нового администратора';

$head = new Head('Регистрация', Application::SITE_FONTS, Application::SITE_STYLES);
$headerPanel = new HeaderPanel();

?>

<?= $head->render() ?>

<body>

<?= $headerPanel->render() ?>

<h1 class="title"><?= $title; ?></h1>

<form action="" method="post" style="opacity: 0.8">
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
