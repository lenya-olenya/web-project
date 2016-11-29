<!DOCTYPE html>

<html lang="en">

<?php

require_once ROOT . '/templates/Head.php';
require_once ROOT . '/templates/HeaderPanel.php';

$head = new Head($p['title'], Application::SITE_FONTS, Application::SITE_STYLES);
$headerPanel = new HeaderPanel();

?>

<?= $head->render() ?>

<body>

<?= $headerPanel->render() ?>

<main>
  <article>
    <header><h1 class="title"><?= $p['title'] ?></h1></header>

    <div class="article-content">
        <?= $p['content'] ?>
    </div>

    <footer>
      <span><?= $p['date'] ?></span>
      <span class="back"><a href="/">« Назад к новостям</a></span>
    </footer>
  </article>
</main>

</body>

</html>
