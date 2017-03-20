<!DOCTYPE html>

<html>

<?php

require_once ROOT . '/templates/Head.php';
require_once ROOT . '/templates/HeaderPanel.php';

$head = new Head($p['title']);
$headerPanel = new HeaderPanel();

$head->addStyle(Application::SITE_FONTS);
$head->addStyle(Application::SITE_STYLES)

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
