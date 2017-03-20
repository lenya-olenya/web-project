<!DOCTYPE html>

<html>

<?php

require_once ROOT . '/templates/Head.php';
require_once ROOT . '/templates/HeaderPanel.php';

$title = 'Панель администратора';

$head = new Head($title);
$headerPanel = new HeaderPanel();

$head->addStyle(Application::SITE_FONTS);
$head->addStyle(Application::SITE_STYLES);

?>

<?= $head->render() ?>

<body>

<?= $headerPanel->render() ?>

<main>
  <ul class="scroll-area">
    <li>1</li>
    <li>2</li>
    <li>3</li>
    <li>4</li>
    <li>1</li>
    <li>2</li>
    <li>3</li>
    <li>4</li>
    <li>1</li>
    <li>2</li>
    <li>3</li>
    <li>4</li>
    <li>1</li>
    <li>2</li>
    <li>3</li>
    <li>4</li>
    <li>1</li>
    <li>2</li>
    <li>3</li>
    <li>4</li>
    <li>1</li>
    <li>2</li>
    <li>3</li>
    <li>4</li>
    <li>1</li>
    <li>2</li>
    <li>3</li>
    <li>4</li>
    <li>1</li>
    <li>2</li>
    <li>3</li>
    <li>4</li>
    <li>1</li>
    <li>2</li>
    <li>3</li>
    <li>4</li>
    <li>1</li>
    <li>2</li>
    <li>3</li>
    <li>4</li>
    <li>1</li>
    <li>2</li>
    <li>3</li>
    <li>4</li>
    <li>1</li>
    <li>2</li>
    <li>3</li>
    <li>4</li>
  </ul>
</main>

<!--hello admin-->

</body>

</html>
