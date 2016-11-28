<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Title</title>
</head>

<body>

<?php foreach ($publications as $p): ?>
  <article>
    <header>
      <a href="/publication/show/<?= $p['id'] ?>"><?= $p['title'] ?></a>
    </header>

    <p>
      <?= $p['description'] ?>
    </p>

    <footer>
      <?= $p['date'] ?>
    </footer>
  </article>
<?php endforeach; ?>

</body>

</html>
