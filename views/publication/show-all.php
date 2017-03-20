<!DOCTYPE html>

<html>

<?php

require_once ROOT . '/templates/Head.php';
require_once ROOT . '/templates/HeaderPanel.php';
require_once ROOT . '/templates/Pagination.php';

$title = 'Главная';

$head = new Head($title);
$header = new HeaderPanel();
$pagination = new Pagination();

$head->addStyle(Application::SITE_FONTS);
$head->addStyle(Application::SITE_STYLES);

$pageCount = ceil($this->_publicationModel->getCount() / (float) $this->_publicationsPerPage);

?>

<?= $head->render() ?>

<body>

<?= $header->render() ?>

<h1 class="title"><?= $title ?></h1>

<main class="publication-list">
  <ul class="article-previews">
    <?php foreach ($publications as $p): ?>
      <li>
        <article class="article-preview">
          <header class="title">
            <a href="/publication/show/<?= $p['id'] ?>"><?= $p['title'] ?></a>
          </header>

          <p><?= $p['description'] ?></p>

          <footer>
            <span><?= $p['date'] ?></span> | Тема:
            <span><?= $this->_themeModel->getName($p['theme_id']) ?></span>

            <span class="more">
              <a href="/publication/show/<?= $p['id'] ?>">Перейти к записи »</a>
            </span>
          </footer>
        </article>
      </li>
    <?php endforeach; ?>
  </ul>

  <div style="text-align: center; clear: both">
      <?= $pagination->render(['activePage' => $page, 'pageCount' => $pageCount]) ?>
  </div>
</main>

</body>

</html>
